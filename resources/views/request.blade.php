@extends('layouts.main')

@section('content') 
<x-guest-layout>
    <form method="POST" action="{{ route('request.store') }}" enctype="multipart/form-data"    >
        @csrf
        <h1 class="text-center mb-20 text-5xl"></h1>
        <h1 class="text-center text-blue-500/100 mb-10 text-4xl">Создание заявки</h1>
        
        <div class="mt-4">
            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" placeholder="fullname" required autocomplete="fullname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="theme" class="block mt-1 w-full" type="text" name="theme" :value="old('theme')" placeholder="theme" required autocomplete="theme" />
            <x-input-error :messages="$errors->get('theme')" class="mt-2" />
        </div>

        <select id="section_id" name="section_id" class="block mt-4 w-full" required>
            @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->title }}</option>
            @endforeach
        </select>

        <div class="mt-4">
            <x-text-input id="path_img" class="block mt-1 w-full" type="file" name="path_img" :value="old('path_img')" placeholder="path_img" required autocomplete="path_img" />
            <x-input-error :messages="$errors->get('path_img')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Создать заявку') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection      
  <!-- Date 
        <div class="mt-4">
            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autocomplete="date" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>
            -->
        <!-- Time 
        <div class="mt-4">
            <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required autocomplete="time" />
            <x-input-error :messages="$errors->get('time')" class="mt-2" />
        </div>
        -->
        <!-- Service Selection 
        <select id="service_id" name="service_id" class="block mt-4 w-full" required>
            {{-- @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->title }}</option>
            @endforeach --}}
        </select>
-->