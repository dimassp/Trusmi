<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $data_kpi = DB::select(
            "SELECT
                karyawan,
                target_sales,
                actual_sales,
                pencapaian_sales,
                bobot_sales,
                late_sales,
                (bobot_sales + late_sales) as total_bobot_sales,
                target_report,
                actual_report,
                pencapaian_report,
                bobot_report,
                late_report,
                (bobot_report + late_report) as total_bobot_report,
                (bobot_report + late_report + bobot_sales + late_sales) as kpi
            FROM (
                SELECT
                        karyawan,
                        target_sales,
                        actual_sales,
                        target_report,
                        actual_report,
                        (actual_sales / target_sales) * 100 as pencapaian_sales,
                        (actual_sales / target_sales) * 100 / 2 as bobot_sales,
                        (-7 * total_late_sales) as late_sales,
                        (actual_report / target_report) * 100 as pencapaian_report,
                        (actual_report / target_report) * 100 / 2 as bobot_report,
                        (-7 * total_late_report) as late_report
                FROM (
                    SELECT
                        karyawan,
                        SUM( CASE WHEN kpi = 'Sales' THEN 1 ELSE 0 END ) as target_sales,
                        SUM( CASE WHEN aktual IS NOT NULL and kpi = 'Sales' THEN 1 ELSE 0 END ) as actual_sales,
                        SUM( CASE WHEN aktual > deadline and kpi = 'Sales' THEN 1 ELSE 0 END ) as total_late_sales,
                        SUM( CASE WHEN kpi = 'Report' THEN 1 ELSE 0 END ) as target_report,	
                        SUM( CASE WHEN aktual IS NOT NULL and kpi = 'Report' THEN 1 ELSE 0 END ) as actual_report,
                        SUM( CASE WHEN aktual > deadline and kpi = 'Report' THEN 1 ELSE 0 END ) as total_late_report
                    FROM
                        table_kpi_marketing
                    GROUP BY 
                        karyawan
                ) AS subquery1
            ) AS subquery2;"
        );

        $data_total_per_status = DB::select(
            "SELECT 
                total_data,
                total_late,
                (total_late / total_data) * 100 as late_percentage,
                total_ontime,
                (total_ontime / total_data) * 100 as ontime_percentage
            FROM (
                SELECT
                    total_data,
                    total_late,
                    total_ontime
                FROM (
                    SELECT 
                        COUNT(id) as total_data,
                        SUM(CASE WHEN aktual > deadline THEN 1 ELSE 0 END) as total_late,
                        SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) as total_ontime
                    FROM 
                        table_kpi_marketing
                ) as subquery2
            ) as subquery1;
        ");
        $karyawan_name = [];
        $target_sales = [];
        $actual_sales = [];
        $pencapaian_sales = [];
        $total_bobot_sales = [];

        $target_report = [];
        $actual_report = [];
        $pencapaian_report = [];
        $total_bobot_report = [];

        $kpi = [];

        foreach ($data_kpi as $key => $value) {
            array_push($karyawan_name, $value->karyawan);
            array_push($target_sales, $value->target_sales);
            array_push($actual_sales, $value->actual_sales);
            array_push($pencapaian_sales, $value->pencapaian_sales);
            array_push($total_bobot_sales, $value->total_bobot_sales);

            array_push($target_report, $value->target_report);
            array_push($actual_report, $value->actual_report);
            array_push($pencapaian_report, $value->pencapaian_report);
            array_push($total_bobot_report, $value->total_bobot_report);

            array_push($kpi, $value->kpi);
        }

        $labels_kpi = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            'Extra 1', 'Extra 2', 'Extra 3', 'Extra 4'
        ];

        $data_total_per_status = $data_total_per_status[0];

        return view('dashboard', compact('data_total_per_status','pencapaian_sales','total_bobot_sales','pencapaian_report','total_bobot_report','kpi','actual_report','target_report', 'karyawan_name', 'target_sales', 'labels_kpi', 'actual_sales'));
    }
}
