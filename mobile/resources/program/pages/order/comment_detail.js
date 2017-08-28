//index.js  
//获取应用实例  
var app = getApp()
const AV = require('../../utils/av-weapp.js');
var token
Page({
  data: {
    tempFilePaths: '',
    commentDetail: {
      goods_thumb: "",
      goods_name:"结婚把手机呢人家能够进入那个就让你就让你就热闹了就看热闹客家人你好软件库女孩看见了让女孩了",
      shop_price:"50"
    }
      
    
  },

  onLoad: function () {
    token = wx.getStorageSync('token')
    var that = this


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
  chooseimage: function () {
    var _this = this;
    wx.chooseImage({
      count: 9, // 默认9  
      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有  
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有  
      success: function (res) {
        // 返回选定照片的本地文件路径列表，tempFilePath可以作为img标签的src属性显示图片  
        _this.setData({
          tempFilePaths: res.tempFilePaths
        })
        var tempFilePath = res.tempFilePaths[0];
        new AV.File('file-name', {
          blob: {
            uri: tempFilePath,
          },
        }).save().then(
          file => console.log(file.url())
          ).catch(console.error);
      }
    })
  },

  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    var that = this
    wx.stopPullDownRefresh()
    that.onLoad()

  },
  commentBtn: function () {
    wx.navigateTo({
      url: '../order/comment_detail'
    })
  },

})



