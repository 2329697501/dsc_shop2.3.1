var app = getApp();
Page({
  data:{
    hiddenallOrder: false,
    hiddenOrder: true,
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
    var token = wx.getStorageSync('token')
    //资金明细
    wx.request({
      url: app.apiUrl("account/detail "),
      data: {
        page:"1",
        size:"1"
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        that.setData({
          allList:res.data.data
        })
     
      }
    })
    //提现记录
    wx.request({
      url: app.apiUrl("account/log"),
      data: {
        "page": 1,
        "size": 1,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        that.setData({
          allList: res.data.data
        })
      }
    })
        //加载中
    this.loadingChange()
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 1000)
  },

  toOrder: function (res) {
    this.setData({
      hiddenOrder: false,
      hiddenallOrder: true,
    })

  },
  allOrder: function (res) {
   
    this.setData({
      hiddenOrder: true,
      hiddenallOrder: false,
    })
  },


})