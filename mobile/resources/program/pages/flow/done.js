var app = getApp()
var token
Page({
  data: {
    defaultSize: 'default',
    primarySize: 'default',
    warnSize: 'default',
    disabled: false,
    plain: false,
    loading: false,

    done: {
      name: '付款金额',
      price: '7520.00',
    },
    doneList: [
      {
        order_sn: '订单号',

      },
      {
        order_sn: '配送方式',
      }
    ],
    flowMoney: {
      checkoutUrl: '../user/index',
    }
  },

  onLoad: function (e) {
    token = wx.getStorageSync('token')
    var that = this

    //加载中
    this.loadingChange()

    //获取订单信息
    var order_id = e.id
    console.log(order_id);
    wx.request({
      url: app.apiUrl('user/order/detail'),
      method: "post",
      data: {
        id: order_id
      },
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        console.log(res.data.data)
        that.setData({
          doneList: res.data.data,
          donePrice:res.data.data,
        })

      }
    })

  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 2000)
  },
  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    wx.stopPullDownRefresh()
  },
  primary: function (e) {
    var order_id = e.currentTarget.dataset.id
    var openid = wx.getStorageSync('openid')
    app.payOrder(order_id, openid, token)
  },
  orderDetail: function () {
    wx.navigateTo({
      url: '../user/index'
    })
  },


})