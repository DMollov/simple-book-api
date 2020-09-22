@extends('layout')

@section('content')
    <div class="flex bg-gray-100">
        <div class="container mx-auto text-xl font-mono">
            <router-link to="/" exact>Home</router-link>
        </div>
    </div>
    <div class="container mx-auto">
        <router-view></router-view>
    </div>
@endsection

