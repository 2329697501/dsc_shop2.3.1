var app = getApp()
Page({
  data: {
    array: ['美国', '中国', '巴西', '日本'],
    index: 0,
    date: '2016-09-01',
    time: '12:01',
    orderJtou: '../../res/images/icon-arrowdown.png',
    //配送方式
    payTypes: ['请选择', '支付宝', '余额付款', '货到付款'],
    payTypesIndex: 0,
  },

  onLoad: function () {
    //加载中
    this.loadingChange()
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 2000)
  },
  //充值方式
  payTypeChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      payTypesIndex: e.detail.value
    })
  },
  formSubmit: function (e) {
    var that = this
    var token = wx.getStorageSync('token')

    wx.request({
      url: app.apiUrl('user/account/deposit'),
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
  //获得表单数据
    var formData = e.detail.value;
    console.log(formData)
    if (e.detail.value.price.length == 0 || e.detail.value.cont.length == 0) {
      wx.showToast({
        title: '金额内容不能为空',
        icon: 'success',
        duration: 2000
      })
    } else {
      wx.showModal({
        title: '您确定要充值￥500到余额？',
        success: function (res) {
          if (res.confirm) {
            wx.redirectTo({ url: '../user/index' })
          } else if (res.cancel) {
            console.log('用户点击取消')
          }
        }
      })
      wx.redirectTo({ url: '../user/index' })
    }
    //获得表单数据
    var objData = e.detail.value;
    if (objData.userName && objData.idcard && objData.mobile && objData.email) {
      // 同步方式存储表单数据
      wx.setStorageSync('userName', objData.userName);
      wx.setStorageSync('idcard', objData.idcard);
      wx.setStorageSync('mobile', objData.mobile);
      wx.setStorageSync('email', objData.email);
    }


  },
  formReset: function () {
    console.log('form发生了reset事件');
    this.modalTap2();
  } 
})