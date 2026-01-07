<?php
namespace App\Livewire\Pages\Admin;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Dashboard Overview')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. STATS CARDS DATA
        $totalStudents     = User::where('role', 'student')->count();
        $totalCourses      = Course::count();
        $activeEnrollments = Enrollment::where('is_completed', false)->count();

        // Hitung Estimasi Pendapatan (Enrollment * Harga Kursus)
        // Asumsi: Semua enrollment dianggap lunas/transaksi
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        // 2. CHART AREA: Pendaftaran 7 Hari Terakhir
        $chartAreaLabels = [];
        $chartAreaData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date              = Carbon::now()->subDays($i);
            $chartAreaLabels[] = $date->format('d M'); // Label Tgl (ex: 12 Jan)

            // Hitung enrollment pada tanggal tersebut
            $count           = Enrollment::whereDate('created_at', $date->format('Y-m-d'))->count();
            $chartAreaData[] = $count;
        }

        // 3. CHART DONUT: Kursus per Kategori
        $categories       = Category::withCount('courses')->get();
        $chartDonutLabels = $categories->pluck('name')->toArray();
        $chartDonutData   = $categories->pluck('courses_count')->toArray();

        // Jika kosong, kasih dummy data biar chart gak error visualnya
        if (empty($chartDonutData)) {
            $chartDonutLabels = ['No Data'];
            $chartDonutData   = [1];
        }

        // 4. TABEL: 5 Pendaftar Terakhir
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.pages.admin.dashboard', [
            'stats'             => [
                'students' => $totalStudents,
                'courses'  => $totalCourses,
                'active'   => $activeEnrollments,
                'revenue'  => $totalRevenue,
            ],
            'chartArea'         => [
                'labels' => $chartAreaLabels,
                'data'   => $chartAreaData,
            ],
            'chartDonut'        => [
                'labels' => $chartDonutLabels,
                'data'   => $chartDonutData,
            ],
            'recentEnrollments' => $recentEnrollments,
        ]);
    }
}
