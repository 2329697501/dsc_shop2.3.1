var app = getApp()
var token
Page({
  data: {
    collectgoods:[],
  },
  getCartGoods: function (that) {
    var token = wx.getStorageSync('token')
    //调用应用实例的方法获取全局数据
    wx.request({
      url: app.apiUrl("user/collectgoods"),
      method: "POST",
      data:{
        page:1,
        size:10
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
  /*收藏*/
  delCollect: function (e) {
    var that = this;
    var index = e.currentTarget.dataset.index;
    var goodsId = that.data.collectgoods[index].goods_id;
    var token = wx.getStorageSync('token')
    wx.request({
      url: app.apiUrl("user/collect/add"),
      data: {
        "id": goodsId,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        var result = res.data.data;
        if (result == 1) {
          wx.showToast({
            title: '收藏已取消',
            icon: 'warn',
            duration: 2000
          })
        } 
      }
    })
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
    // wx.request({
    //   url: app.apiUrl("goods/detail"),
    //   data: {
    //     "id": order.id,
    //   },
    //   method: "post",
    //   header: {
    //     'Content-Type': 'application/json',
    //     'X-ECTouch-Authorization': token
    //   },
    //   success: function (res) {
    //     var result = res.data.data.goods_info.is_collect;
    //     if (result == 1) {
    //       wx.showToast({
    //         title: '收藏成功',
    //         icon: 'warn',
    //         duration: 2000
    //       })
    //     } else {
    //       wx.showToast({
    //         title: '取消收藏',
    //         icon: 'warn',
    //         duration: 2000
    //       })
    //     }
    //     that.setData({
    //       collect: res.data.data.goods_info,
    //     })
    //   }
    // })
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

})