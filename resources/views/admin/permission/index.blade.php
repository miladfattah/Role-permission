<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Permission Name
                                            </th>
                                            <th scope="col" class="p-4">
                                                <span class="">
                                                    <a href="{{route('admin.permission.create')}}" class=" bg-green-700 text-white py-2 px-4 text-xs rounded">Create</a>
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @foreach ($permissions as $permission)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$permission->name}}</td>
                                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                    <a href="{{route('admin.permission.edit' , $permission->id)}}" class="text-blue-600  hover:underline">Edit</a>
                                                    <form action="{{route('admin.permission.destroy' , $permission->id)}}" method="POST" class="text-red-600 inline hover:underline">
                                                        @csrf 
                                                        @method('DELETE')
                                                        <button type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-admin-layout>
