<x-app-layout>
    <div id="personal" v-cloak class="flex items-start justify-center py-2 max-w-7xl mx-auto mt-4 overflow-hidden">
        <div class="bg-white w-1/5 mr-6 sm:rounded-sm p-2 rounded-lg overflow-hidden divide-y divide-solid">
            <div @click.stop="changeTab('avatar')" class="w-full flex justify-center items-center h-16 text-xl cursor-pointer hover:bg-gray-100" :class="[tab === 'avatar' ? 'bg-gray-100' : '']">My Avatar</div>
            <div @click.stop="changeTab('info')" class="w-full flex justify-center items-center h-16 text-xl cursor-pointer hover:bg-gray-100" :class="[tab === 'info' ? 'bg-gray-100' : '']">My Information</div>
            <div @click.stop="changeTab('password')" class="w-full flex justify-center items-center h-16 text-xl cursor-pointer hover:bg-gray-100" :class="[tab === 'password' ? 'bg-gray-100' : '']">Edit Password</div>
            <div @click.stop="changeTab('posts')" class="w-full flex justify-center items-center h-16 text-xl cursor-pointer hover:bg-gray-100" :class="[tab === 'posts' ? 'bg-gray-100' : '']">My Posts</div>
        </div>
        <div class="w-auto flex-1 rounded-lg">
            <div class="overflow-hidden shadow-sm">
                <div v-show="tab === 'avatar'" class="py-12 flex flex-col items-center bg-white border-b border-gray-200">
                    <img class="w-1/4 rounded-2xl" src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="">
                    <input @change="editAvatar" id="chooseAvatar" class="hidden" accept="image/png, image/jpeg" type="file">
                    <label class="mt-10 cursor-pointer" for="chooseAvatar">
                        <div class="bg-gray-200 py-4 px-10 rounded-lg text-lg">Upload</div>
                    </label>
                </div>
                <div v-show="tab === 'info'" class="py-24 flex flex-col items-center bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <label class="block">
                            <span class="block text-sm font-medium text-slate-700">Name</span>
                            <input type="text" v-model="userInfo.name" placeholder="{{ \Illuminate\Support\Facades\Auth::user()->name }}" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <label class="block mt-8">
                            <span class="block text-sm font-medium text-slate-700">Nickname</span>
                            <input type="text" v-model="userInfo.nickname" placeholder="{{ \Illuminate\Support\Facades\Auth::user()->nickname }}" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <label class="block mt-8">
                            <span class="block text-sm font-medium text-slate-700">Slogan</span>
                            <textarea type="text" v-model="userInfo.slogan" placeholder="{{ \Illuminate\Support\Facades\Auth::user()->slogan }}" rows="5" class="resize-none mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "></textarea>
                        </label>
                        <button @click.stop="editInfo" class="mt-10 bg-gray-200 py-2 px-4 rounded-lg text-lg">Save</button>
                    </div>
                </div>
                <div v-show="tab === 'password'" class="py-24 flex flex-col items-center bg-white border-b border-gray-200">
                    <div class="w-1/2">
                        <label class="block">
                            <span class="block text-sm font-medium text-slate-700">Old Password</span>
                            <input type="password" v-model="passwordInfo.oldPassword" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <label class="block mt-8">
                            <span class="block text-sm font-medium text-slate-700">Password</span>
                            <input type="password" v-model="passwordInfo.password"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <label class="block mt-8">
                            <span class="block text-sm font-medium text-slate-700">Confirm Password</span>
                            <input type="password" v-model="passwordInfo.rePassword"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <button @click.stop="editPassword" class="mt-10 bg-gray-200 py-2 px-4 rounded-lg text-lg">Save</button>
                    </div>
                </div>
                <div v-show="tab === 'posts'" class="flex flex-col items-center border-b border-gray-200 overflow-hidden">
                    @foreach($list as $item)
                        <div class="bg-white w-full mb-6 p-8 flex justify-between items-start overflow-hidden shadow-sm sm:rounded-lg">
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
                                <div class="avatar flex flex-wrap my-4">
                                    @foreach($item['students_avatar'] as $avatar)
                                        <img class="w-12 h-12 object-cover m-1 rounded-full" src="{{ $avatar }}" alt="">
                                    @endforeach
                                </div>
                                <div class="option w-full my-2 text-base flex items-center">
                                    @if($item['state'] === 1)
                                        <div @click.stop="editArticleState('{{ $item['id'] }}', 0)" class="bg-gray-200 py-2 px-6 mr-6 rounded-md cursor-pointer hover:bg-black hover:text-white">Hide</div>
                                    @else
                                        <div @click.stop="editArticleState('{{ $item['id'] }}', 1)" class="bg-gray-200 py-2 px-6 mr-6 rounded-md cursor-pointer hover:bg-black hover:text-white">Show</div>
                                    @endif
                                    <div @click.stop="openEditPostPopup('{{ $item['id'] }}')" class="bg-gray-200 py-2 px-6 mr-6 rounded-md cursor-pointer hover:bg-black hover:text-white">Edit</div>
                                    <div @click.stop="deleteArticle('{{ $item['id'] }}')" class="bg-gray-200 py-2 px-6 mr-6 rounded-md cursor-pointer hover:bg-black hover:text-white">Delete</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div v-show="editPostPopupState" @click.stop="closeEditPostPopup" id="edit-popup" class="absolute z-50 w-full h-full bg-black/50 left-0 top-0 flex justify-center items-center">
            <div class="w-1/2 h-auto bg-white rounded-lg overflow-hidden p-8">
                <div class="row w-full flex items-center">
                    <label class="w-1/2 mt-8">
                        <span class="block text-sm font-medium text-slate-700">Type</span>
                        <select v-model="editPostInfo.type" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
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
                    <label class="w-1/2 mt-8 ml-24">
                        <span class="block text-sm font-medium text-slate-700">Subject</span>
                        <input v-model="editPostInfo.subject" type="text" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                </div>
                <div class="row w-full flex items-center">
                    <label class="w-1/2 mt-8">
                        <span class="block text-sm font-medium text-slate-700">Cost</span>
                        <input v-model="editPostInfo.cost" type="text" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                    <label class="w-1/2 mt-8 ml-24">
                        <span class="block text-sm font-medium text-slate-700">Max Number Of People</span>
                        <input v-model="editPostInfo.count" type="number" min="1" placeholder="" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
                                  disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                    </label>
                </div>
                <div class="row w-full flex items-center">
                    <label class="w-full mt-8">
                        <span class="block text-sm font-medium text-slate-700">Details</span>
                        <textarea v-model="editPostInfo.details" maxlength="240" rows="5" placeholder="" class="mt-1 resize-none block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
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
                            v-model="editPostInfo.avatarList"
                            :default-file-list="editPostInfo.avatarList"
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
                    <button @click.stop="EditPost" class="mt-10 bg-gray-200 py-2 px-4 rounded-lg text-lg">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/personal.js') }}"></script>
</x-app-layout>
