//index.js
//获取应用实例
var app = getApp()
var goodsId = 0
Page({
  data: {
    hiddenOrder: false,
    hiddenAddress: true,
    current: 0,
    number: 1,
    carModels: [],
    good: 'top-hoverd-btn',
    new: '',
    child: '',
    goodsInfoCont: "",
  },
  onLoad: function (options) {
    var that = this
    goodsId = options.objectId;

    console.log(goodsId)

    wx.request({
      url: app.apiUrl("goods/detail"),
      data: {
        "id": goodsId,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json'
      },
      success: function (res) {
        that.setData({
          goodsInfoCont: res.data.properties,
        })
      }
    })
    //加载中
    this.loadingChange()
  },
  //事件处理函数
  //头部菜单切换(商品 详情、评论)
  toNew: function () {
    // console.log('new');
    this.updateBtnStatus('new');
    wx.redirectTo({
      url: "../goods/index?objectId=" + goodsId
    })
  },
  toGood: function () {
    // console.log('good');
    this.updateBtnStatus('good');
    wx.redirectTo({
      url: "../goods/detail?objectId=" + goodsId
    })
  },
  toChild: function () {
    //console.log('child');
    this.updateBtnStatus('child');
    wx.redirectTo({
      url: "../goods/comment?objectId=" + goodsId
    })
  },
  updateBtnStatus: function (k) {
    this.setData({
      new: this.getHoverd('new', k),
      good: this.getHoverd('good', k),
      child: this.getHoverd('child', k),
    });
  },
  getHoverd: function (src, dest) {
    return (src === dest ? 'top-hoverd-btn' : '');
  },
/**内容切换 */
  toOrder: function (res) {
    this.setData({
      hiddenOrder: false,
      hiddenAddress: true
    })
  },
  toAddress: function (res) {
    this.setData({
      hiddenOrder: true,
      hiddenAddress: false
    })
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 1000)
  },
})








