<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Rate;
use App\CustomerReview;
use App\Book;
use App\CartBook;
use App\Bill;
use App\Order;

class UserController extends Controller
{
    public function storeRate(Request $request)
    {
        $data = $request->only('user_id', 'user_token', 'book_id', 'rate');
        $user = User::find($data['user_id']);
        $book = Book::find($data['book_id']);
        if ($user && $book && ($user->token == $data['user_token'])) {
            DB::beginTransaction();
            try {
                $rate = Rate::where([
                    'book_id' => $data['book_id'],
                    'user_id' => $data['user_id']
                ])->first();
                if (count($rate) <= 0) {
                    $rate = new Rate;
                    $rate->book_id = $data['book_id'];
                    $rate->user_id = $data['user_id'];
                }
                $rate->point = $data['rate'];
                $rate->save();
                $rs = Rate::where('book_id', $book->id)->get();
                $sumRate = 0;
                foreach ($rs as $key => $r) {
                    $sumRate += $r->point;
                }
                $book->rate_average = $sumRate / count($rs);
                $book->save();
                DB::commit();
                return json_encode(['status' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
        return json_encode(['status' => 'failed']);
    }

    public function storeReview(Request $request)
    {
        $data = $request->only('user_id', 'user_token', 'book_id', 'review');
        $user = User::find($data['user_id']);
        if ($user && ($user->token == $data['user_token'])) {
            DB::beginTransaction();
            try {
                $review = new CustomerReview;
                $review->book_id = $data['book_id'];
                $review->user_id = $data['user_id'];
                $review->content = $data['review'];
                $review->save();
                DB::commit();
                return json_encode(['status' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
        return json_encode(['status' => 'failed']);
    }

    public function storeBill(Request $request)
    {
        $error = 'error';
        try {
            $user = json_decode($request->user, true);
            $carts = json_decode($request->carts, true);

            $u = User::find($user['user_id']);
            if ($u && ($u->token == $user['user_token'])) {
                foreach ($carts as $key => $cart) {
                    $book = Book::find($cart['book_id']);
                    if ($book->quantity_remain > 0) {
                        $qty = $book->quantity_remain - ((int) $cart['quantity']);
                        if ($qty > 0) {
                            continue;
                        } else {
                            $error = $error . ' - ' . $book->title . ' chỉ còn' . $book->quantity_remain . ' cuốn';
                            break;
                        }
                    } else {
                        $error = $error . '-' . $book->title . 'hết hàng';
                        break;
                    }
                }
                if ($error == 'error') {
                    DB::beginTransaction();
                    try {
                        //save bill
                        $bill = new Bill;
                        $bill->user_id = $u->id;
                        $bill->status = 'processing';
                        $bill->name_customer = $user['name'];
                        $bill->phone = $user['phone'];
                        $bill->address = $user['address'];
                        $bill->save();

                        $order = new Order;
                        $order->bill_id = $bill->id;
                        $total = 0;
                        $order->total_cost = 0;
                        $order->save();

                        foreach ($carts as $key => $cart) {
                            $book = Book::find($cart['book_id']);
                            //save cartbook
                            $cartbook = new CartBook;
                            $cartbook->order_id = $order->id;
                            $cartbook->book_id = $cart['book_id'];
                            $cartbook->quantity = $cart['quantity'];

                            $total += $book->new_price * $cart['quantity'];

                            $cartbook->save();

                            $book->quantity_selling += $cart['quantity'];
                            $book->quantity_remain -= $cart['quantity'];
                            $book->save();

                        }

                        $order->total_cost = $total;
                        $order->save();
                        DB::commit();
                        return json_encode(['status' => 'success']);
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 'failed', 'error' => $e]);
        }
        return json_encode(['status' => 'failed', 'error' => $error]);
    }

    public function getBook(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user && ($user->token == $request->user_token)) {
            $skip = $request->query('skip');
            return DB::table('bills')
                ->where('bills.user_id', $user->id)
                ->where('bills.status', '<>', 'cancel')
                ->join('orders', 'orders.bill_id', '=', 'bills.id')
                ->join('cart_books', 'cart_books.order_id', '=', 'orders.id')
                ->join('books', 'cart_books.book_id', '=', 'books.id')
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->orderBy('cart_books.created_at', 'DESC')
                ->select('books.id', 'books.title', 'books.image_url as urlImage', 'books.rate_average as rateAverage', 'books.price as old_price', 'books.new_price as price', 'authors.name as author')
                ->skip($skip)->take(10)->distinct()->get()->toJson();
        }
    }
}
