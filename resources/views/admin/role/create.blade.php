<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="flex flex-col max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 md:flex-row md:h-48">
                    <div class="md:flex md:items-center md:justify-center md:w-1/2 md:bg-gray-700 md:dark:bg-gray-800">
                        <div class="px-6 py-6 md:px-8 md:py-0">
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 md:text-gray-400">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur obcaecati odio</p>
                        </div>
                    </div>
            
                    <div class="flex items-center justify-center pb-6 md:py-0 md:w-1/2">
                        <form action="{{route('admin.roles.store')}}" method="POST">
                            @csrf
                            <div class="flex flex-col p-1 overflow-hidden border rounded-lg dark:border-gray-600 lg:flex-row dark:focus-within:border-blue-300 focus-within:ring focus-within:ring-opacity-40 focus-within:border-blue-400 focus-within:ring-blue-300">
                                <input class="px-6 py-2 text-gray-700 placeholder-gray-500 bg-white outline-none border-none focus:border-none focus:placeholder-transparent dark:focus:placeholder-transparent focus:outline-none" type="text" name="name" placeholder="Enter your Role" >
                                
                                <button type="submit" class="px-4 py-3 text-sm font-medium tracking-wider text-gray-100 uppercase transition-colors duration-200 transform bg-green-700 rounded-lg hover:bg-green-600 focus:bg-green-600 focus:outline-none">SAVE</button>
                            </div>
                            @error('name')
                                <small class="text-red-700">{{$message}}</small>
                            @enderror
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
