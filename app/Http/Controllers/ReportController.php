<?php
// ReportController.php
namespace App\Http\Controllers;
use App\Models\Submission;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Retrieve all submissions
        $submissions = Order::all();

        return view('report', compact('submissions'));
    }

    public function filter(Request $request)
    {
        // Retrieve the filter values from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userId = $request->input('user_id');

        // Query the submissions based on the filters
        $query = Order::query();

        if ($startDate) {
            $query->where('entry_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('entry_at', '<=', $endDate);
        }

        if ($userId) {
            $query->where('entry_by', $userId);
        }

        // Get the filtered submissions
        $submissions = $query->get();

        return view('report', compact('submissions'));
    }
}
