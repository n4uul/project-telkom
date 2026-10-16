@extends('layouts.app')

@section('title', 'Login - SIM Ekstrakurikuler')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="w-full max-w-md">
        <!-- Login Card Glassmorphism -->
        <div class="telu-glass rounded-3xl p-8 shadow-2xl relative overflow-hidden border-t-4 border-red-700">
            <!-- Background Glow Ornament -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-600/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-red-700 text-white flex items-center justify-center text-2xl mx-auto mb-4 shadow-lg">
                    🔐
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">MASUK AKUN</h2>
                <p class="text-slate-600 font-medium text-sm mt-1">SIM Ekstrakurikuler Sekolah</p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('home') }}" method="GET" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">Email / ID Pengguna</label>
                    <input 
                        type="text" 
                        name="email" 
                        placeholder="Masukkan email atau ID Anda" 
                        required
                        class="w-full bg-white/70 border border-slate-200 focus:border-red-600 rounded-2xl px-4 py-3 text-slate-900 font-bold placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600/30 transition-all"
                    >
                </div>

                <div>
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required
                        class="w-full bg-white/70 border border-slate-200 focus:border-red-600 rounded-2xl px-4 py-3 text-slate-900 font-bold placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600/30 transition-all"
                    >
                </div>

                <div class="flex items-center justify-between text-xs font-bold text-slate-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="rounded border-slate-300 text-red-700 focus:ring-red-600">
                        <span>Ingat Saya</span>
                    </label>
                    <a href="#" class="text-red-700 hover:underline">Lupa Password?</a>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-red-700 hover:bg-red-800 text-white font-extrabold py-3.5 rounded-2xl shadow-lg jelly-hover jelly-click transition-all flex items-center justify-center gap-2 mt-2"
                >
                    <span>Masuk ke Sistem</span>
                    <span>→</span>
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-xs font-medium text-slate-500">
                    Belum punya akun? <a href="#" class="text-red-700 font-bold hover:underline">Hubungi Admin Ekstra</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection