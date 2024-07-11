<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;


class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['device', 'ip_address'];

    public static function recordVisit()
    {
        $ipAddress = request()->ip();

        $device = request()->header('User-Agent');

        // Check if a session variable is set to avoid counting the same visitor multiple times during a session
        if (!Session::get('visited')) {
            self::create(['ip_address' => $ipAddress, 'device' => $device]);
            Session::put('visited', true);
        }
    }

    public static function getTotalVisitors($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);

        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        return self::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * @param $date
     * @return mixed
     * function that returns the rate of the visitors in specific month according to last month.
     */
    public static function rateVisitors($date)
    {
        $parsedDate = Carbon::createFromFormat('Y-n', $date);

        $startDate = $parsedDate->copy()->startOfMonth();
        $endDate = $parsedDate->copy()->endOfMonth();

        $lastMonth = $parsedDate->copy()->subMonth();

        $lastMonthStartDate = $lastMonth->copy()->startOfMonth();
        $lastMonthEndDate = $lastMonth->copy()->endOfMonth();

        $newVisitors = self::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address');

        $oldVisitors = self::whereBetween('created_at', [$lastMonthStartDate, $lastMonthEndDate])
            ->distinct('ip_address')
            ->count('ip_address');

        if($oldVisitors == 0){
            return 100;
        }
        $rate = (($newVisitors/$oldVisitors)*100);
        return $rate;
    }
}
