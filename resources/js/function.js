import Axios from "axios";
import { Message } from "@arco-design/web-vue";


/**
 * 判断变量是否为空
 *
 * @param data
 * @returns {boolean}
 */
let isNull = (data) => {
    if (data === "") { //检验空字符串
        return true;
    } else if (data === "null") { //检验字符串类型的null
        return true;
    } else if (data === "undefined") { //检验字符串类型的 undefined
        return true;
    } else if (!data && data !== 0 && data !=="") { //检验 undefined 和 null
        return true;
    } else if (Object.prototype.toString.call(data) === '[object Array]' && data.length === 0) { //检验空数组
        return true;
    } else if (Object.prototype.toString.call(data) === '[object Object]' && Object.keys(data).length === 0) { //检验空对象
        return true;
    }
    return false;
};


/**
 * 页面跳转
 *
 * @param page 跳转路径
 * @param target 跳转方式 1当前页面 2新页面
 */
let openPage = (page, target = 1) => {
    if(!isNull(page)) {
        if(target === 2) {
            window.open(page);
        } else {
            window.location.href = page;
        }
    }

    return true;
};


// 全局提示
let messageTip = (message, type = 'info') => {
    switch (type) {
        case "success":
            Message.success(message);
            break;
        case "warning":
            Message.warning(message);
            break;
        case "error":
            Message.error(message);
            break;
        case  "loading":
            Message.loading(message);
            break;
        case "normal":
            Message.normal(message);
            break;
        case "clear":
            Message.clear();
            break;
        default:
            Message.info(message);
    }
};


/**
 * 网络请求
 *
 * @param option
 */
let request = (option) => {
    const Request = Axios.create({
        baseURL: "/",
        timeout: 600000,
    });
    let failFun = option.fail || function () {};
    let completeFun = option.complete ||  function () {};
    let successFun = option.success || function () {};
    let errorFun = option.error || function () {};

    // 请求拦截器
    Request.interceptors.request.use((config) => {
            config.headers['Content-Type'] = "application/json";
            let token = localStorage.getItem("UT") || null;
            if (token) {
                config.headers['Accept-Token'] = token;
            }
            return config;
        },
        (error) => {
            messageTip("Network Error", "error");
            return Promise.reject(error);
        });

    // 请求主体
    Request.request({
        url: option.url || "",
        method: option.method || "POST",
        headers: option.headers || {},
        data: option.data || {},
        responseType: option.responseType || "json",
    }).then((response) => {
        let responseData = response.data;
        if(response.status === 200) {
            if(responseData.c === 999999) {  // 重新登录
                messageTip(responseData.m, "info");
                setTimeout(() => {
                    window.location.href = "/login";
                }, 1000);
            } else {
                if(responseData.c === 200000) {
                    successFun(responseData, response);
                } else {
                    if(responseData.c === 999998) {  // 页面刷新
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } else if(responseData.c === 300000) {  // 页面重定向
                        messageTip(responseData.m, "error");
                        setTimeout(() => {
                            window.location.href = responseData.d.path ?? '/';
                        }, 500);
                    } else {
                        messageTip(responseData.m, "error");
                        errorFun(responseData, response);
                    }
                }
                completeFun(responseData, response);
            }
        } else {
            messageTip("Network Error", "error");
            failFun(response);
        }
    }).catch((response) => {
        messageTip("Network Error", "error");
        failFun(response);
    });
};


export default {
    isNull,
    openPage,
    messageTip,
    request,
};
