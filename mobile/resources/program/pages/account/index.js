var app = getApp();
Page({
  data:{
  account:{
    price:'1900.00',
  },
  accountList: [
    {
      admin: "充值",
      orderJtou: '../../res/images/icon-arrowdown.png',
      link:"../account/recharge"
    },
    {
      admin: "提现",
      orderJtou: '../../res/images/icon-arrowdown.png',
      link: "../account/withdraw"
    }

  ],
  allList: [
    {
      num: "订单号：548541254558458",
      price: "-50",
      time: "2017-12-06"
    },
    {
      num: "订单号：548541254558458",
      price: "-50",
      time: "2017-12-06"
    },

  ],
  detailList: [
    {
      num: "提现",
      price: "-50",
      time: "2017-12-06"
    },
  
  ],
  },

  onLoad: function () {
    var that = this
    //推荐商品列表
    var token = wx.getStorageSync('token')
    // console.log(token)
    wx.request({
      url: app.apiUrl("user/account "),
      method: "POST",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        // console.log(res)
        that.setData({
          account:res.data.data
        })
      }
    })
    //加载中
    this.loadingChange();
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 1000)
  },
})