<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     *The Default Variables That The Dashboard Needs
     */
    public function default_vars_needed($date = null): array
    {
        if ($date === null) {
            $date = Carbon::now()->format('Y-n');
        }

        $visitors = Visitor::getTotalVisitors($date);
        $rateVisitors = Visitor::rateVisitors($date);
        $new_customers = $this->new_customers($date);
        $rate_customers = $this->rate_customers($date);
        $Conversion_rate = $this->conversion_rate($date );
        $rateConversion = $this->rateConversion($date);
        $products = $this->products($date);
        $rateProducts = $this->rateProducts($date);
        $sales = $this->sales($date);
        $rateSales = $this->rateSales($date);
        $avg_orders_value = $this->avg_orders_value($date);
        $rate_avg_orders_value = $this->rate_avg_orders_value($date);
        $orders = $this->orders($date);
        $rateOrders = $this->rateOrders($date);
        $delivered_orders = $this->delivered_orders($date);
        $rate_delivered_orders = $this->rate_delivered_orders($date);
        $returned_orders = $this->returned_orders($date);
        $rate_returned_orders = $this->rate_returned_orders($date);
        $pending_orders = $this->pending_orders($date);
        $rate_pending_orders = $this->rate_pending_orders($date);

        return get_defined_vars();
    }

    /**
     *display the view of Dashboard
     */
    public function create(): view
    {
        $vars = $this->default_vars_needed();
        $best_products = $this->get_best_products();
        $latest_orders = $this->get_latest_orders();
        $user_devices = $this->get_user_device();
        return view('admin.dashboard', get_defined_vars());
    }

    /**
     * function for the statistics part in the view
     */
    public function statistics(Request $request): view
    {
        $vars = $this->default_vars_needed($request->date);
        $best_products = $this->get_best_products();
        $latest_orders = $this->get_latest_orders();
        $user_devices = $this->get_user_device();
        return view('admin.dashboard', get_defined_vars());
    }

    /**
     *function for the device visitors part in the view
     */
    public function visited_by_device(Request $request): view
    {
        $vars = $this->default_vars_needed();
        $best_products = $this->get_best_products();
        $latest_orders = $this->get_latest_orders();
        $user_devices = $this->get_user_device($request->date);
        return view('admin.dashboard', get_defined_vars());
    }

    /**
     *function for the best products part in the view
     */
    public function best_products(Request $request): view
    {
        $vars = $this->default_vars_needed();
        $user_devices = $this->get_user_device($request->date);
        $latest_orders = $this->get_latest_orders();
        $best_products = $this->get_best_products($request->date);

        return view('admin.dashboard', get_defined_vars());
    }

    /**
     * function for the latest orders part in the view
     */
    public function latest_orders(Request $request): view
    {
        $vars = $this->default_vars_needed($request->date);
        $best_products = $this->get_best_products();
        $latest_orders = $this->get_latest_orders($request->date);
        $user_devices = $this->get_user_device($request->date);

        return view('admin.dashboard', get_defined_vars());
    }

    /**
     * updating the given order
     */
    public function update_order(Order $order, $status): view
    {
        $order->update([
            'status' => $status,
        ]);

        $vars = $this->default_vars_needed();
        $best_products = $this->get_best_products();
        $latest_orders = $this->get_latest_orders();
        $user_devices = $this->get_user_device();

        return view('admin.dashboard', get_defined_vars());
    }


    /**
     * this is the functions that used in the main parts of the view and used in the above functions
     */

    /**
     * function that return the latest visitors to the site within specific time
     */
    public function visitors($date)
    {
        return Visitor::getTotalVisitors($date);
    }

    public function new_customers($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return User::whereBetween('created_at', [$startDate, $endDate])->count('id');
    }

    public function rate_customers($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newUsers = User::whereBetween('created_at', [$startDate, $endDate])->count('id');
        $oldUsers = User::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->count('id');

        if($oldUsers == 0){
            return 100;
        }
        $rate = (($newUsers/$oldUsers)*100);
        return $rate;
    }

    /**
     * conversion  rate = dividing the total number of orders placed
     *                    by the total number of unique visits to your website.
     */
    public function conversion_rate($date): float|int
    {
        $totalOrders = $this->orders($date);
        $totalUniqueVisits = $this->visitors($date);
        return ($totalUniqueVisits > 0) ? ($totalOrders / $totalUniqueVisits) * 100 : 0;
    }

    public function rateConversion($date): float|int
    {
        $totalOrders = $this->orders($date);
        $totalUniqueVisits = $this->visitors($date);
        $newConversion =  (($totalUniqueVisits > 0) ? ($totalOrders / $totalUniqueVisits) * 100 : 0);

        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $lastMonth = $parsedDate->copy()->subMonth();
        $oldDate = $lastMonth->format('Y-n');

        $lastTotalOrders = $this->orders($oldDate);
        $lastTotalUniqueVisits = $this->visitors($oldDate);

        $oldConversion = (($lastTotalUniqueVisits > 0) ? ($lastTotalOrders / $lastTotalUniqueVisits) * 100 : 0);

        if ($oldConversion == 0){
            return 100;
        }
        $rate = (($newConversion/$oldConversion)*100);
        return $rate;
    }

    public function products($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Product::whereBetween('created_at', [$startDate, $endDate])->count('id');
    }

    public function rateProducts($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newProducts = Product::whereBetween('created_at', [$startDate, $endDate])->count('id');

        $oldProducts = Product::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->count('id');

        if($oldProducts == 0){
            return 100;
        }
        $rate = (($newProducts/$oldProducts)*100);
        return $rate;
    }


    public function sales($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_value');
    }

    public function rateSales($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();


        $newSales = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_value');
        $oldSales = Order::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->sum('total_value');

        if($oldSales == 0){
            return 100;
        }
        $rate = (($newSales/$oldSales)*100);
        return $rate;
    }

    public function avg_orders_value($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::whereBetween('created_at', [$startDate, $endDate])->avg('total_value');
    }

    public function rate_avg_orders_value($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newAvg = Order::whereBetween('created_at', [$startDate, $endDate])->avg('total_value');
        $oldAvg = Order::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->avg('total_value');

        if($oldAvg == 0){
            return 100;
        }
        $rate = (($newAvg/$oldAvg)*100);
        return $rate;
    }

    public function orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::with('products')->whereBetween('created_at', [$startDate, $endDate])->count('id');
    }

    public function rateOrders($date): float|int
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newOrders = Order::with('products')->whereBetween('created_at', [$startDate, $endDate])->count('id');
        $oldOrders = Order::with('products')->whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->count('id');

        if($oldOrders == 0){
            return 100;
        }
        $rate = (($newOrders/$oldOrders)*100);
        return $rate;
    }

    public function delivered_orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'shipped')->count('id');
    }

    public function rate_delivered_orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newOrders = Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'shipped')->count('id');
        $oldOrders = Order::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->where('status', 'shipped')->count('id');

        if($oldOrders == 0){
            return 100;
        }
        $rate = (($newOrders/$oldOrders)*100);
        return $rate;
    }


    public function returned_orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'cancelled')->count('id');
    }

    public function rate_returned_orders($date): float|int
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newOrders = Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'cancelled')->count('id');
        $oldOrders = Order::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->where('status', 'cancelled')->count('id');

        if($oldOrders == 0){
            return 100;
        }
        $rate = (($newOrders/$oldOrders)*100);
        return $rate;
    }

    public function pending_orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'in production')->count('id');
    }

    public function rate_pending_orders($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newOrders = Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 'in production')->count('id');
        $oldOrders = Order::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])->where('status', 'in production')->count('id');

        if($oldOrders == 0){
            return 100;
        }
        $rate = (($newOrders/$oldOrders)*100);
        return $rate;
    }

    public function get_best_products($date = null)
    {
        if ($date === null) {
            $date = Carbon::now()->format('Y-n');
        }

        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Product::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('sales_count', 'desc')
            ->paginate(5);
    }

    public function get_latest_orders($date = null)
    {
        if ($date === null) {
            $date = Carbon::now()->format('Y-n');
        }
        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return Order::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    /**
     * function to get the type of user device [ Desktop, phone ]
     */
    public function get_user_device($date = null): array
    {
        if ($date === null) {
            $date = Carbon::now()->format('Y-n');
        }

        $parsedDate = Carbon::createFromFormat('Y-n', $date);
        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $visits = Visitor::whereBetween('created_at', [$startDate, $endDate])->get();

        $desktopCount = 0;
        $phoneCount = 0;

        foreach ($visits as $visit) {
            $userAgentString = strtolower($visit->device);

            if (strpos($userAgentString, 'mobile') !== false) {
                $phoneCount++;
            } elseif (strpos($userAgentString, 'windows') !== false ||
                strpos($userAgentString, 'linux') !== false ||
                strpos($userAgentString, 'macintosh') !== false) {
                $desktopCount++;
            }
        }
        if (count($visits)){
            $desktop_rate = ($desktopCount / count($visits)) * 100;
            $phone_rate = ($phoneCount / count($visits)) * 100 ;

            return  ['phone_rate' => $phone_rate, 'desktop_rate' => $desktop_rate];
        }
        return ['phone_rate' => 0, 'desktop_rate' => 0];
    }
}
