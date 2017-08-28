var app = getApp();
Page({
  data: {
  },
  onLoad: function () {
    var that = this
    //调用应用实例的方法获取全局数据
    app.getUserInfo(function (userInfo) {
      //更新数据
      that.setData({
        userInfo: userInfo
      })
    })
    //获取本地数据
    var userName = wx.getStorageSync('userName');
    var idcard = wx.getStorageSync('idcard');
    var mobile = wx.getStorageSync('mobile');
    var email = wx.getStorageSync('email');
    if (userName) {
      this.setData({ userName: userName });
    }
    if (idcard) {
      this.setData({ idcard: idcard });
    }
    if (mobile) {
      this.setData({ mobile: mobile });
    }
    if (email) {
      this.setData({ email: email });
    }
  },
  //提交信息
  formSubmit: function (e) {
    //获得表单数据
    var objData = e.detail.value;
    if (e.detail.value.userName.length == 0 || e.detail.value.idcard.length == 0 || e.detail.value.mobile.length == 0 || e.detail.value.email.length == 0) {
      wx.showToast({
        title: '信息不能为空',
        icon: 'success',
        duration: 2000
      })
    } else {
      if (objData.userName == wx.getStorageSync('userName') && objData.idcard == wx.getStorageSync('idcard') && objData.mobile == wx.getStorageSync('mobile') && objData.email == wx.getStorageSync('email')) {
        wx.showToast({
          title: '内容没有变化',
          icon: 'success',
          duration: 2000
        })
      } else {
        wx.showToast({
          title: '保存成功',
          icon: 'success',
          duration: 2000
        }),
          setTimeout(() => {
            wx.switchTab({
              url: "../user/index",
            })
          }, 1000)
      }

    }
    if (objData.userName && objData.idcard && objData.mobile && objData.email) {
      // 同步方式存储表单数据
      wx.setStorageSync('userName', objData.userName);
      wx.setStorageSync('idcard', objData.idcard);
      wx.setStorageSync('mobile', objData.mobile);
      wx.setStorageSync('email', objData.email);
    }
  },
})  