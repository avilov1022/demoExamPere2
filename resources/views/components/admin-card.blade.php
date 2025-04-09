<div class="flex justify-center items-center bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mb-2">
        <h2 class="font-bold text-xl mb-2">Заявка от {{ $report->created_at ? $report->created_at->format('d.m.Y') : 'Неизвестное время' }}</h2>
        <p><strong>Пользователь:</strong> {{ $report->user->name ?? 'Неизвестный пользователь' }}</p> 
        <p><strong>Тема:</strong> {{ $report-> theme }}</p>
        <p><img src="{{ asset('images/'.$work->path_img) }}" alt="profile Pic" height="200" width="200">        </p>
    </div>
</div>