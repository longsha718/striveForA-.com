import { createApp } from 'vue'
import Utils from "./function";
import ArcoVue from '@arco-design/web-vue';
import '@arco-design/web-vue/dist/arco.css';
import { IconClose, IconPen } from '@arco-design/web-vue/es/icon';

createApp({
    components: {
        IconClose,
        IconPen
    },
    data () {
        return {
            publishState:false,
            searchInfo: {
                type: null,
                subject: null,
                details: null,
            },
            postInfo: {
                type: "",
                subject: "",
                cost: "",
                count: "",
                registered: "",
                details: "",
                avatarList: [],
            }
        }
    },
    methods: {
        goLoginPage () {
            window.location.href = '/login';
        },
        avatarUpload (item) {
            if(item.response.c !== 200000) {
                Utils.messageTip(item.response.m, "error");
                return false;
            } else {
                if(!Utils.isNull(item.response.d.avatar)) {
                    item.url = item.response.d.avatar;
                    this.postInfo.avatarList.push(item);
                }
            }
        },
        avatarBeforeRemove (item) {
            this.postInfo.avatarList.forEach((file, index) => {
                if(file.uid === item.uid) {
                    this.postInfo.avatarList.splice(index, 1);
                }
            });
            return true;
        },
        publishPost () {
            let avatarList = this.postInfo.avatarList;
            let newAvatarList = [];
            avatarList.forEach((item) => {
                if(!Utils.isNull(item.response)) {
                    newAvatarList.push(item.response.d.avatar);
                } else {
                    newAvatarList.push(item);
                }
            });
            this.postInfo.avatarList = newAvatarList;
            this.postInfo.registered = this.postInfo.avatarList.length;

            Utils.request({
                url: '/article/publish',
                data: this.postInfo,
                success: (json) => {
                    Utils.messageTip(json.m, "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
            });
        },
        search () {
            let newUrl = '/index/' + (this.searchInfo.type || 0) + "/" + (this.searchInfo.subject || 0) + "/" + (this.searchInfo.details || 0);
            window.location.href = newUrl;
        }
    },
}).use(ArcoVue).mount("#header");


createApp({
    data () {
        return {
            //
        }
    },
    methods: {
        //
    },
}).mount("#index");
