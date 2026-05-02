<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalReservasi = Reservation::count();
        $pending = Reservation::where('status', 'pending')->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        return view('admin.dashboard', compact('totalReservasi', 'pending', 'confirmed', 'cancelled'));
    }

    public function reservations()
    {
        $reservations = Reservation::latest()->paginate(10);
        return view('admin.reservations', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);
        return back()->with('success', 'Status reservasi berhasil diupdate!');
    }

    public function deleteReservation($id)
    {
        Reservation::findOrFail($id)->delete();
        return back()->with('success', 'Reservasi berhasil dihapus!');
    }
}