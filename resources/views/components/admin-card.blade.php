<div class="flex justify-center items-center bg-gray-100 mt-3">
    <div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mb-2">
        <h2 class="font-bold text-xl mb-2">Заявка от {{ $report->created_at ? $report->created_at->format('d.m.Y') : 'Неизвестное время' }}</h2>
        <p><strong>Пользователь:</strong> {{ $report->user->FullName() ?? 'Неизвестный пользователь' }}</p> 
        <p><strong>Тема:</strong> {{ $report-> theme }}</p>
        <p><img src="{{ asset('image/'. $report->path_img) }}" alt="profile Pic" height="200" width="200"></p>

        <select name="" id="" class="mt-4">
            <option value="">Одобрить</option>
            <option value="">Отклонить</option>
        </select>
    </div>
</div>