<x-app-layout>
    <x-slot name="header">
        <div id="header" v-cloak>
            <h2 v-show="!publishState" class="flex items-center justify-between font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Latest Posts') }}
                <div class="search flex items-center mx-6">
                    <div class="flex items-center mr-6">
                        <div class="mr-4">Type: </div>
                        <select v-model="searchInfo.type" class="mt-1  block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            ">
                            <option value="primary school">Primary School</option>
                            <option value="junior high school">Junior High School</option>
                            <option value="high school">High School</option>
                        </select>
                    </div>
                    <div class="flex items-center mr-6">
                        <div class="mr-4">Subject: </div>
                        <input v-model="searchInfo.subject" type="text" placeholder="Search..." class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                          focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                          disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                          invalid:border-pink-500 invalid:text-pink-600
                          focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                    "/>
                    </div>
                    <div class="flex items-center mr-6">
                        <div class="mr-4">Details: </div>
                        <input v-model="searchInfo.details" type="text" placeholder="Search..." class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                          focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                          disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                          invalid:border-pink-500 invalid:text-pink-600
                          focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                    "/>
                    </div>
                    <div class="flex items-center mr-6">
                        <div @click.stop="search" class="bg-gray-200 py-2 px-6 rounded-lg text-base cursor-pointer">Search</div>
                    </div>
                </div>
                @auth('web')
                    <icon-pen class="cursor-pointer" @click.stop="publishState = !this.publishState" size="30" />
                @endauth
                @guest('web')
                    <icon-pen class="cursor-pointer" @click.stop="goLoginPage" size="30" />
                @endguest
            </h2>
            <h2 v-show="publishState" class="flex items-center justify-between font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Publish Posts') }}
                <icon-close class="cursor-pointer" @click.stop="publishState = !this.publishState" size="30" />
            </h2>
            <div v-show="publishState" class="form mt-4 mb-12 bg-white h-auto">
                <div class="row w-full flex items-center">
                    <label class="w-1/3 mt-8">
                        <span class="block text-sm font-medium text-slate-700">Type</span>
                        <select v-model="postInfo.type" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            ">
                            <option value="primary school">Primary School</option>
                            <option value="junior high school">Junior High School</option>
                            <option value="high school">High School</option>
                        </select>
                    </label>
                    <label class="w-1/3 mt-8 ml-24">
                        <span class="block text-sm font-medium text-slate-700">Subject</span>
                        <input v-model="postInfo.subject" type="text" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                </div>
                <div class="row w-full flex items-center">
                    <label class="w-1/3 mt-8">
                        <span class="block text-sm font-medium text-slate-700">Cost</span>
                        <input v-model="postInfo.cost" type="number" min="0" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                    <label class="w-1/3 mt-8 ml-24">
                        <span class="block text-sm font-medium text-slate-700">Max Number Of People</span>
                        <input v-model="postInfo.count" type="number" min="1" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                </div>
                <div class="row w-full flex items-center">
                    <label class="w-3/4 mt-8">
                        <span class="block text-sm font-medium text-slate-700">Details</span>
                        <textarea v-model="postInfo.details" maxlength="240" rows="5" placeholder="" class="mt-1 resize-none block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "></textarea>
                    </label>
                </div>
                <div class="row w-full flex items-center">
                    <div class="w-3/4 mt-8">
                        <span class="block text-sm font-medium text-slate-700 mb-2">Registered students</span>
                        <a-upload
                            multiple
                            list-type="picture-card"
                            action="/api/file/upload"
                            accept="image/png,image/jpeg"
                            image-preview
                            @success="avatarUpload"
                            @before-remove="avatarBeforeRemove"
                        />
                    </div>
                </div>
                <div class="row w-full flex items-center">
                    <button @click.stop="publishPost" class="mt-10 bg-gray-200 py-2 px-4 rounded-lg text-lg">Publish</button>
                </div>
            </div>
        </div>
    </x-slot>

    <div id="index" v-cloak class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            @foreach($list as $item)
                <div class="bg-white my-6 p-8 flex justify-between items-start overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="avatar w-1/5 shrink-0 rounded-lg overflow-hidden">
                        <img src="{{ $item['avatar'] }}" alt="">
                        <div class="w-full text-center text-xl font-black my-2">{{ $item['name'] }}</div>
                        <div class="w-full text-center text-lg">{{ $item['email'] }}</div>
                    </div>
                    <div class="content w-auto flex-1 flex flex-col ml-8 overflow-hidden">
                        <div class="overview flex items-center justify-between border-b-2 py-4">
                            <div class="item w-1/4 flex flex-col text-center py-6 px-2">
                                <div class="text-2xl mb-4 font-black">Type</div>
                                <div class="text-xl">{{ $item['type'] }}</div>
                            </div>
                            <div class="item w-1/4 flex flex-col text-center py-6 px-2">
                                <div class="text-2xl mb-4 font-black">Subject</div>
                                <div class="text-xl">{{ $item['subject'] }}</div>
                            </div>
                            <div class="item w-1/4 flex flex-col text-center py-6 px-2">
                                <div class="text-2xl mb-4 font-black">Cost</div>
                                <div class="text-xl">${{ $item['cost'] }}</div>
                            </div>
                            <div class="item w-1/4 flex flex-col text-center py-6 px-2">
                                <div class="text-2xl mb-4 font-black">Registered</div>
                                <div class="text-xl">{{ $item['registered'] ." / " . $item['count'] }}</div>
                            </div>
                        </div>
                        <div class="details text-base text-justify flex-1 py-8 border-b-2">{{ $item['details'] }}</div>
                        <div class="avatar flex flex-wrap mt-4">
                            @foreach($item['students_avatar'] as $avatar)
                                <img class="w-12 h-12 object-cover m-1 rounded-full" src="{{ $avatar }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/index.js') }}"></script>
</x-app-layout>
