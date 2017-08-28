var app = getApp();
Page({
  data: {
    hidden: false,
    indicatorDots: true,
    autoplay: true,
    interval: 4000,
    duration: 1000,
    banners: [],    //轮播图
    activityLeft: [],//左广告位
    activityRight: [], //右广告位
    boutiqueList: [],//精品商品推荐
    indexGoods: [],//猜你喜欢
    headerSearch: {//搜索
      searchSize: '17',
      searchColor: 'rgba(255,255,255,.8)',
      classifyUrl: "../../images/fenlei.png",
      name: "请输入您搜索的商品",
    },
  },
  onLoad: function () {
    var that = this
    //推荐商品列表
    var token = wx.getStorageSync('token')
    // console.log(token)
    wx.request({
      url: app.apiUrl("index "),
      method: "POST",
      success: function (res) {
        // console.log(res)
        that.setData({
          banner: res.data.data.banner,
          activityLeft: res.data.data.adsense[0],
          activityRight: res.data.data.adsense.splice(1, 2),
          boutiqueList: res.data.data.goods_list,
          indexGoods: res.data.data.goods_list
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

//获取点击的id值
  siteDetail: function (e) {
    var that = this
    var index = e.currentTarget.dataset.index;
    // consoleconsole.log(index)
    var goodsId = that.data.indexGoods[index].goods_id;
    //  console.log(goodsId)
    wx.navigateTo({
      url: "../goods/index?objectId=" + goodsId
    });
  },
  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    wx.stopPullDownRefresh()
  },
  // 搜索链接
  bindSearchTap: function () {
    wx.navigateTo({
      url: '../search/index'
    })
  },
  // 分类链接
  bindCateTap: function () {
    wx.switchTab({
      url: '../categroy/index'
    })
  },
  //分享
  onShareAppMessage: function () {
    return {
      title: '小程序首页',
      desc: '小程序本身无需下载，无需注册，不占用手机内存，可以跨平台使用，响应迅速，体验接近原生App',
      path: '/pages/index/index'
    }
  }
})