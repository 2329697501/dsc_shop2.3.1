var app = getApp();
Page({
  data: {
    hiddenallOrder: false,
    hiddenOrder: true,
    hiddenAddress: true,
    couponsList:[
      {
        price:"100",
        title:"注册立即赠100元优惠券",
        cont:"满 2000 元可用",
        time:"2017-06-27"
      },
      {
        price: "50",
        title: "注册立即赠100元优惠券",
        cont: "满 2000 元可用",
        time: "2017-06-27"
      }
    ]
  },

  onLoad: function () {
    var that = this
    var token = wx.getStorageSync('token')
    console.log(111)
    wx.request({
      url: app.apiUrl("conpont"),
      data: {
        page: "1",
        size: "1",
        type:"1"
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {

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
      hiddenAddress: true,
      hiddenallOrder: true,
    })
  },
  toAddress: function (res) {
    this.setData({
      hiddenOrder: true,
      hiddenAddress: false,
      hiddenallOrder: true,
    })
  },
  allOrder: function (res) {
    this.setData({
      hiddenOrder: true,
      hiddenAddress: true,
      hiddenallOrder: false,
    })
  },
})