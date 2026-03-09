<div class="space-y-4">
    @php
        $properties = $getState();
        $attributes = $properties['attributes'] ?? [];
        $old = $properties['old'] ?? [];
    @endphp

    @if(!empty($attributes))
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse border border-gray-200 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800">
                        <th class="p-2 border border-gray-200 dark:border-gray-700">Trường</th>
                        @if(!empty($old))
                            <th class="p-2 border border-gray-200 dark:border-gray-700 text-danger-600">Giá trị cũ</th>
                        @endif
                        <th class="p-2 border border-gray-200 dark:border-gray-700 text-success-600">Giá trị mới</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $key => $value)
                        @if($key === 'updated_at' || $key === 'created_at') @continue @endif
                        <tr>
                            <td class="p-2 border border-gray-200 dark:border-gray-700 font-medium italic">{{ $key }}</td>
                            @if(!empty($old))
                                <td class="p-2 border border-gray-200 dark:border-gray-700 text-gray-500">
                                    {{ is_array($old[$key] ?? null) ? json_encode($old[$key]) : ($old[$key] ?? 'N/A') }}
                                </td>
                            @endif
                            <td class="p-2 border border-gray-200 dark:border-gray-700">
                                {{ is_array($value) ? json_encode($value) : $value }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 italic">Không có chi tiết thay đổi cụ thể.</p>
    @endif
</div>
