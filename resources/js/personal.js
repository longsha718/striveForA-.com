import { createApp } from 'vue'
import Utils from "./function";
import ArcoVue from '@arco-design/web-vue';
import '@arco-design/web-vue/dist/arco.css';


createApp({
    data() {
        return {
            tab: 'avatar',
            avatarFile: [],
            userInfo: {
                name: "",
                nickname: "",
                slogan: "",
            },
            passwordInfo: {
                oldPassword: "",
                password: "",
                rePassword: "",
            },
            editPostId: 0,
            editPostPopupState: false,
            editPostInfo: {
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
        changeTab(tab) {
            window.location.href = '/personal#' + tab;
        },
        editAvatar (file) {
            let formData = new FormData;
            formData.append("avatar", file.target.files[0]);

            Utils.request({
                url: '/user/edit-avatar',
                data: formData,
                success: () => {
                    Utils.messageTip("Avatar modified successfully", "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            });
        },
        editInfo () {
            Utils.request({
                url: "/user/edit-info",
                data: this.userInfo,
                success: () => {
                    Utils.messageTip("Modified successfully", "success");
                }
            });
        },
        editPassword () {
            Utils.request({
                url: '/user/edit-password',
                data: this.passwordInfo,
                success: () => {
                    Utils.messageTip("Modified successfully", "success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            });
        },
        editArticleState (article, state) {
            Utils.request({
                url: '/article/edit-state',
                data: {
                    article,
                    state,
                },
                success: (json) => {
                    Utils.messageTip(json.m, "success");
                    setTimeout(() => {
                        window.location.href = '/personal#posts';
                        window.location.reload();
                    }, 1000);
                }
            });
        },
        deleteArticle (article) {
            Utils.request({
                url: '/article/delete',
                data: {
                    article,
                },
                success: (json) => {
                    Utils.messageTip(json.m, "success");
                    setTimeout(() => {
                        window.location.href = '/personal#posts';
                        window.location.reload();
                    }, 1000);
                }
            });
        },
        openEditPostPopup (article) {
            this.editPostId = article;
            Utils.request({
                url: '/article/get-info',
                data: {
                    article,
                },
                success: (json) => {
                    this.editPostInfo = json.d.info;
                    this.editPostInfo.avatarList = [];
                    this.editPostPopupState = true;
                }
            });
        },
        closeEditPostPopup (e) {
            if(e.target.id === 'edit-popup') {
                this.editPostId = 0;
                this.editPostPopupState = false;
                this.editPostInfo = {
                    type: "",
                    subject: "",
                    cost: "",
                    count: "",
                    details: "",
                };
            }
        },
        avatarUpload (item) {
            if(item.response.c !== 200000) {
                Utils.messageTip(item.response.m, "error");
                return false;
            } else {
                if(!Utils.isNull(item.response.d.avatar)) {
                    item.url = item.response.d.avatar;
                    this.editPostInfo.avatarList.push(item);
                }
            }
        },
        avatarBeforeRemove (item) {
            this.editPostInfo.avatarList.forEach((file, index) => {
                if(file.uid === item.uid) {
                    this.editPostInfo.avatarList.splice(index, 1);
                }
            });
            return true;
        },
        EditPost () {
            let avatarList = this.editPostInfo.avatarList;
            let newAvatarList = [];
            avatarList.forEach((item) => {
                if(!Utils.isNull(item.response)) {
                    newAvatarList.push(item.response.d.avatar);
                } else {
                    newAvatarList.push(item);
                }
            });
            this.editPostInfo.avatarList = newAvatarList;
            this.editPostInfo.registered = this.editPostInfo.avatarList.length;

            let param = this.editPostInfo;
            param.article = this.editPostId;

            Utils.request({
                url: '/article/edit-info',
                data: param,
                success: (json) => {
                    Utils.messageTip(json.m, "success");
                    setTimeout(() => {
                        window.location.href = '/personal#posts';
                        window.location.reload();
                    }, 1000);
                }
            });
        },
        hashchange () {
            this.tab = window.location.hash.split('#')[1] ?? "avatar";
        }
    },
    mounted () {
        window.onhashchange = this.hashchange;
        this.tab = window.location.hash.split('#')[1] ?? "avatar";
    }
}).use(ArcoVue).mount("#personal");
