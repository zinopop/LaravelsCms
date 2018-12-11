$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [ o[this.name] ];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
function getQueryString(a) {
    a = new RegExp("(^|&)" + a + "=([^&]*)(&|$)");
    a = window.location.search.substr(1).match(a);
    return null != a ? a[2] : ""
}

function addCookie(a, b, c) {
    a = a + "=" + escape(b) + "; path=/";
    0 < c && (b = new Date, b.setTime(b.getTime() + 36E5 * c), a = a + ";expires=" + b.toGMTString());
    document.cookie = a
}

function getCookie(a) {
    for (var b = document.cookie.split("; "), c = 0; c < b.length; c++) {
        var d = b[c].split("=");
        if (d[0] == a) return unescape(d[1])
    }
    return null
}

function delCookie(a) {
    var b = new Date;
    b.setTime(b.getTime() - 1);
    var c = getCookie(a);
    null != c && (document.cookie = a + "=" + c + "; path=/;expires=" + b.toGMTString())
}
var fieldValidate = function() {
    return {
        Init: function(a, b) {
            var c = !0;
            $.each(b, function(b, e) {
                if ("" == a[b]) return layer.msg(e), c = !1
            });
            return c
        }
    }
};
//判断汉字长度
function getLenght(str) {
    return str.replace(/[\u0391-\uFFE5]/g,"aa").length;
}

//基于tips的表单验证
function validateTips(role){
    var reData = new Array();
    $.each(role,function (index,val) {
        if(val.data == '' || val.data == null){
            layer.tips(val.message,val.choose,{tips:1,tipsMore:true});
            reData.push(val);
        }
    });
    return reData.length;
}


function formatDateTime() {
    var date = new Date();
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    m = m < 10 ? ('0' + m) : m;
    var d = date.getDate();
    d = d < 10 ? ('0' + d) : d;
    var h = date.getHours();
    h = h < 10 ? ('0' + h) : h;
    var minute = date.getMinutes();
    var second = date.getSeconds();
    minute = minute < 10 ? ('0' + minute) : minute;
    second = second < 10 ? ('0' + second) : second;
    return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;
};