<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\baseController as APIBaseController;
use App\Http\Controllers\Controller;
use App\Mail\verifiedUserMail;
use App\Models\User;
use App\Models\Location;
use App\Models\MappingCategory;
use App\Models\MappingItem;
use App\Models\MappingBank;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\TemporaryOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class apiController extends APIBaseController
{
	public function login(Request $request)
	{
		//dd('hai');

		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$auth = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

		if ($auth) {
			//cek apakah sudah verified
			$cekUser = User::where('email', $request->email)->first();

			//Jika belum verfikasi email munculkan pesan
			if ($cekUser->email_verified_at == '') {
				return $this->sendError('Unverified User.', ['error' => 'Please Check Your Email & Verified Your Account First.']);
			} else {
				$token = 'PB' . $request->email;
				$user = Auth::user();
				$success['token'] =  $user->createToken($token)->accessToken;
				$success['fullname'] =  $user->name;
				$success['id_user'] =  $user->id;
				$success['email'] =  $user->email;
				$success['id_lok'] =  $user->id_lok;

				return $this->sendResponse($success, 'Authentication Successfully.');
			}
		} else {
			return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
		}
	}

	public function registerUser(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required',
			'phone' => 'required',
			'id_card' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$password = Hash::make($request->password);
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $password,
			'phone' => $request->phone,
			'role' => 'User',
			'id_card' => $request->id_card,
		]);

		$success['name'] =  $user->name;
		// $url = 'http://127.0.0.1:8000/verified-user/'.encrypt($user->id);
		$url = 'https://penitipan.gotrain.id/verified-user/' . encrypt($user->id);

		$details = [
			'user_name' => $user->name,
			'url' => $url
		];

		$recipient = $request->email;
		//$recipient='vanturgo16@gmail.com';

		Mail::to($recipient)
			->send(new verifiedUserMail($details));

		return $this->sendResponse($success, 'User register successfully.');
	}

	public function getLocation()
	{
		$query = Location::orderBy('loc_name', 'asc');

		$count = $query->count();
		$locations = $query->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $locations,
		];

		return response()->json($response, 200);
	}

	public function getCategory(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_location' => 'required'
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$query = MappingCategory::where('id_location', $request->id_location)
			->where('cost', '!=', 'null')
			->select(
				'mapping_categories.*',
				'locations.loc_name',
				'luggage_categories.name_category',
				'luggage_categories.weight_from',
				'luggage_categories.weight_until',
				'luggage_categories.unit',
			)
			->leftJoin('luggage_categories', 'mapping_categories.id_category', 'luggage_categories.id')
			->leftJoin('locations', 'mapping_categories.id_location', 'locations.id');

		$count = $query->count();
		$categories = $query->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $categories,
		];

		return response()->json($response, 200);
	}

	public function getItem(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_location' => 'required'
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$query = MappingItem::where('id_location', $request->id_location)
			->where('cost', '!=', 'null')
			->select(
				'mapping_items.*',
				'locations.loc_name',
				'items.item_name',
				'items.weight_from',
				'items.weight_until',
				'items.unit'
			)
			->leftJoin('items', 'mapping_items.id_item', 'items.id')
			->leftJoin('locations', 'mapping_items.id_location', 'locations.id');

		$count = $query->count();
		$categories = $query->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $categories,
		];

		return response()->json($response, 200);
	}

	public function getBank(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_location' => 'required'
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$query = MappingBank::where('id_location', $request->id_location)
			->select(
				'mapping_banks.*',
				'locations.loc_name',
				'banks.bank_name',
				'banks.type',
				'banks.account_name',
				'banks.account_number',
			)
			->leftJoin('banks', 'mapping_banks.id_bank', 'banks.id')
			->leftJoin('locations', 'mapping_banks.id_location', 'locations.id');

		$count = $query->count();
		$banks = $query->orderBy('bank_name', 'asc')->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $banks,
		];

		return response()->json($response, 200);
	}

	public function addItem(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_user' => 'required',
			'id_location' => 'required',
			'id_item' => 'required',
			'item_qty' => 'required|numeric',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		//cek dulu punya transaksi open atau tidak
		$cekOrder = Order::where('id_user', $request->id_user)
			->whereIn('order_status', ['Opened', 'Waiting Payment'])
			->count();

		if ($cekOrder > 0) {
			return $this->sendError('Add Item Error', 'This User Still Have Open Transaction');
		}

		DB::beginTransaction();
		try {
			//cek harga item
			$cekCost = MappingItem::where('id_location', $request->id_location)
				->where('id_item', $request->id_item)
				->first();

			$total = $request->item_qty * $cekCost->cost;

			//cek harga item
			$cekItemExist = TemporaryOrder::where('id_location', $request->id_location)
				->where('id_item', $request->id_item)
				->where('id_user', $request->id_user)
				->count();

			if ($cekItemExist == '0') {
				//insert ke table temporary orders
				$tempOrderStore = TemporaryOrder::create([
					'id_user' => $request->id_user,
					'id_location' => $request->id_location,
					'id_item' => $request->id_item,
					'item_qty' => $request->item_qty,
					'item_cost' => $cekCost->cost,
					'total' => $total,
				]);
			} else {
				//update ke table temporary orders
				$tempOrderStore = TemporaryOrder::where('id_location', $request->id_location)
					->where('id_item', $request->id_item)
					->where('id_user', $request->id_user)
					->update([
						'id_user' => $request->id_user,
						'id_location' => $request->id_location,
						'id_item' => $request->id_item,
						'item_qty' => $request->item_qty,
						'item_cost' => $cekCost->cost,
						'total' => $total,
					]);
			}

			DB::commit();

			return $this->sendResponse('Add Item Success.', 'Success Add Item.');
		} catch (\Throwable $e) {
			DB::rollback();
			return $this->sendError('Add Item Error.', 'Failed Add Item.');
		}
	}

	public function deleteItem(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_user' => 'required',
			'id_location' => 'required',
			'id_item' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}


		DB::beginTransaction();
		try {
			//update ke table temporary orders
			$tempOrderdelete = TemporaryOrder::where('id_location', $request->id_location)
				->where('id_item', $request->id_item)
				->where('id_user', $request->id_user)
				->delete();

			DB::commit();

			return $this->sendResponse('Delete Item Success.', 'Success Delete Item.');
		} catch (\Throwable $e) {
			DB::rollback();
			return $this->sendError('Delete Item Error.', 'Failed Delete Item.');
		}
	}

	public function showOrderTemp(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_user' => 'required',
			'id_location' => 'required'
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}


		$query = TemporaryOrder::where('id_location', $request->id_location)
			->where('id_user', $request->id_user)
			->select(
				'temporary_orders.*',
				'items.item_name',
				'locations.loc_name'
			)
			->leftJoin('items', 'temporary_orders.id_item', 'items.id')
			->leftJoin('locations', 'temporary_orders.id_location', 'locations.id');

		$count = $query->count();
		$datas = $query->orderBy('created_at', 'asc')->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $datas,
		];

		return response()->json($response, 200);
	}

	public function submitOrder(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_user' => 'required',
			'id_location' => 'required',
			'date_start' => 'required|date',
			'date_finish' => 'required|date|after:date_start',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		DB::beginTransaction();
		try {
			//select ke table temporary orders
			$tempOrders = TemporaryOrder::where('id_location', $request->id_location)
				->where('id_user', $request->id_user)
				->get();

			//summary order
			$sumOrders = TemporaryOrder::where('id_location', $request->id_location)
				->where('id_user', $request->id_user)
				->sum('total');

			$date_finish = Carbon::createFromFormat('Y-m-d', $request->date_finish);
			$date_start = Carbon::createFromFormat('Y-m-d', $request->date_start);

			$diff_in_days = $date_finish->diffInDays($date_start);

			$discount = '0';
			$gt = ($sumOrders * $diff_in_days) - $discount;

			//dd($diff_in_days);

			$now = Carbon::now()->format('YmdHis');
			$location = Location::where('id', $request->id_location)->first();
			$codeloc = $location->code;
			$order_no = $codeloc . "/" . $now;

			//insert ke table orders
			$orderCreate = Order::create([
				'order_no' => $order_no,
				'id_user' => $request->id_user,
				'id_location' => $request->id_location,
				'date_start' => $request->date_start,
				'date_finish' => $request->date_finish,
				'day_count' => $diff_in_days,
				'subtotal' => $sumOrders,
				'discount' => $discount,
				'grandtotal' => $gt,
				'order_status' => 'Opened',
			]);

			foreach ($tempOrders as $order) {
				$detailCreate = DetailOrder::create([
					'id_order' => $orderCreate->id,
					'id_item' => $order->id_item,
					'item_qty' => $order->item_qty,
					'item_cost' => $order->item_cost,
					'total' => $order->total,
				]);

				$tempOrderdelete = TemporaryOrder::where('id_location', $request->id_location)
					->where('id_item', $order->id_item)
					->where('id_user', $request->id_user)
					->delete();
			}

			DB::commit();

			return $this->sendResponse('Success', 'Success Confirmation Order');
		} catch (\Throwable $e) {
			DB::rollback();
			return $this->sendError('Error.', 'Failed Confirmation Order');
		}
	}

	public function showOrder(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_user' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}


		$query = Order::where('id_user', $request->id_user)
			->select(
				'orders.*',
				'locations.loc_name',
				'banks.bank_name',
				'banks.type',
				'banks.bank_name',
				'banks.account_name',
				'banks.account_number',
			)
			->leftJoin('locations', 'orders.id_location', 'locations.id')
			->leftJoin('banks', 'orders.payment_by', 'banks.id');

		$count = $query->count();
		$datas = $query->orderBy('created_at', 'asc')->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $datas,
		];

		return response()->json($response, 200);
	}

	public function showDetailOrder(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_order' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}


		$query = DetailOrder::where('id_order', $request->id_order)
			->select(
				'detail_orders.*',
				'items.item_name',
			)
			->leftJoin('items', 'detail_orders.id_item', 'items.id');

		$count = $query->count();
		$datas = $query->orderBy('created_at', 'asc')->get();

		$response = [
			'success' => true,
			'count' => $count,
			'data' => $datas,
		];

		return response()->json($response, 200);
	}

	public function paymentOrder(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_order' => 'required',
			'id_bank' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		//cek dulu punya transaksi sudah paid atau belum
		$cekOrder = Order::where('id', $request->id_order)
			->first();

		if ($cekOrder->order_status == 'Paid') {
			return $this->sendError('Error', 'This Order Already Paid');
		}

		if ($cekOrder->order_status == 'Opened') {
			return $this->sendError('Error', 'Plase Contact Our Staff to Confirm This Order');
		}

		//Status order (Opened, Waiting Payment, Paid)
		//Status rent (Saved, Returned)

		DB::beginTransaction();
		try {
			$now = Carbon::now();

			//update ke table temporary orders
			$orderPay = Order::where('id', $request->id_order)
				->update([
					'order_status' => 'Paid',
					'paid_at' => $now,
					'payment_by' => $request->id_bank,
					'rent_status' => 'Saved',
					'date_start_rent' => $now,
				]);

			DB::commit();

			return $this->sendResponse('Success.', 'Success Paid Order.');
		} catch (\Throwable $e) {
			DB::rollback();
			return $this->sendError('Error.', 'Failed Paid Order.');
		}
	}
}
