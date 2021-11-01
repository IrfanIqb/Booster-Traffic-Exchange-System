<?php namespace App\Http\Controllers;

Use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\Input;
use Session;

class DashboardController extends Controller
{
    public $dashboardController;

    public function __construct(DashboardRepository $dashboardController)
    {
        $this->dashboardController = $dashboardController;
    }

    public function index()
    {
        $response = $this->dashboardController->index();

        $counts = $response['counts'];

        $ticks = [];
        $values = [];
        $points= [];

        foreach ($counts as $index => $count) {
            $ticks[] = [$index, $count->created_at->formatLocalized('%A %d %B %Y')];
            $values[] = [$index, $count->hits];
            $points[] = [$index, $count->points];
        }

        return view('index', ['graph_values' => $values, 'graph_ticks' => $ticks , 'graph_points' => $points]);
    }

    public function support()
    {
        $response = $this->dashboardController->support(Input::get('subject'), Input::get('message'), Input::get('email'));
        if ($response['result'] == 1)
            Session::flash('message', 'Your query submitted successfully ');
        return redirect()->back();

    }

}
