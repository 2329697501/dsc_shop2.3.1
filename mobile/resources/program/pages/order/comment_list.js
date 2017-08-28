var app = getApp()
var token
Page({
  data: {
    collectgoods: [],
    commentDetail: {
      goods_thumb: "",
      goods_name: "结婚把手机呢人家能够进入那个就让你就让你就热闹了就看热闹客家人你好软件库女孩看见了让女孩了",
      shop_price: "50"
    }
  },
  getCartGoods: function (that) {
    var token = wx.getStorageSync('token')
    //调用应用实例的方法获取全局数据
    wx.request({
      url: app.apiUrl("user/collectgoods"),
      method: "POST",
      data: {
        page: 1,
        size: 10
      },
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        that.setData({
          collectgoods: res.data.data
        })


      }
    })
  },
  onLoad: function () {
    token = wx.getStorageSync('token')
    var that = this
    this.getCartGoods(that);

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

  //获取点击的id值
  siteDetail: function (e) {
    var that = this
    var index = e.currentTarget.dataset.index;
    console.log(index)
    var goodsId = that.data.collectgoods[index].goods_id;
    console.log(goodsId)
    wx.navigateTo({
      url: "../goods/index?objectId=" + goodsId
    });
  },
  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    var that = this
    this.getCartGoods(that);
    wx.stopPullDownRefresh()
    that.onLoad()

  },
 commentBtn: function () {
   wx.navigateTo({
      url: '../order/comment_detail'
    })
  },

})