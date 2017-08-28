var app = getApp()
Page({
  data: {
    account: {
      price: '1900.00',
    },
    speak: {
      cont: "近两年健康那就是可能将可能尽可能就看他你今天今天可能金泰呢了解课堂上你居然看湖南台突然就了解了那天软胶囊链接突然间看来你挺进入了你提交那天见你很突然哪里呢讨论就和你条件你天天那天内容.近两年健康那了你提交那天见你很突然哪里呢讨论就和你条件你天天那天内容."
    }

  },
  onLoad: function () {
    var that = this
    var token = wx.getStorageSync('token')
    wx.request({
      url: app.apiUrl('user/withdraw '),
      method: 'POST',
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        that.setData({

        })
      }
    })

    //加载中
    //获取本地数据
    var price = wx.getStorageSync('price');
    var weChat = wx.getStorageSync('weChat');
    var mobile = wx.getStorageSync('mobile');
    if (price) {
      this.setData({ price: price });
    }
    if (weChat) {
      this.setData({ weChat: weChat });
    }
    if (mobile) {
      this.setData({ mobile: mobile });
    }

    this.loadingChange()
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 2000)
  },
  //提交信息
  formSubmit: function (e) {
    if (e.detail.value.price.length == 0 || e.detail.value.weChat.length == 0 || e.detail.value.mobile.length == 0) {
      wx.showToast({
        title: '信息不能为空',
        icon: 'success',
        duration: 2000
      })
    } else {
      wx.showToast({
        title: '提现成功',
        icon: 'success',
        duration: 2000
      })
    }
    //获得表单数据
    var objData = e.detail.value;
    console.log(objData)
    if (objData.price && objData.weChat && objData.mobile) {
      // 同步方式存储表单数据
      wx.setStorageSync('price', objData.price);
      wx.setStorageSync('weChat', objData.weChat);
      wx.setStorageSync('mobile', objData.mobile);
    }
  },
})