@extends('layout')

@section('content')
    <div class="flex bg-gray-100">
        <div class="container mx-auto text-xl font-mono">
            <router-link to="/" exact>Home</router-link>
            <router-link to="/login">Login</router-link>
            <router-link to="/register">Register</router-link>
        </div>
    </div>
    <div class="container mx-auto">
        <router-view></router-view>
    </div>
@endsection

