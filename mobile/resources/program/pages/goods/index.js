var WxParse = require('../../wxParse/wxParse.js');
var app = getApp()
var order = {
  id: "",
  num: 1,
  pro: [],
  prostr: []
}
var goodsbtn = ''
var tempOrderPro = [];
var tempOrderProStr = [];
Page({
  data: {
    is_collect: 0,
    currentIndex: 1,
    // tab切换  
    currentTab: 0,
    maskVisual: 'hidden',
    current: 0,
    num: 1,
    new: 'top-hoverd-btn',
    good: '',
    child: '',
    goodsComment: [],
    properties: [],
    goodJiansImg: '../../images/icon-arrowdown.png',
    indicatorDots: true,
    autoplay: true,
    interval: 4000,
    duration: 1000,
    current: 0,
    number: 1,
    hidden: false,
    //服务
    companyName: 'ECTouch微商城',
    goodsService: [
      {
        title: '正品保证'
      },
      {
        title: '货到付款'
      },
      {
        title: '七天退货'
      },
      {
        title: '极速达'
      }
    ],
    //轮播图
    goodsImg: [],
    indicatorDots: true,
    autoplay: true,
    interval: 4000,
    duration: 1000,
    "properties": [],
    goods: {
      "title": "旅游季包邮Crocs卡骆驰男女中性运动迪特洞洞鞋沙滩凉鞋|11991",
      "price": "526.00",
      "delDateilMoney": "900.00",
      salesNum: "52",
      stock: "5200",
    },
    goodsComment: [
      {
        "name": "乐在晴天",
        "time": "2017-6-22",
        "cont": "第一次购买非常的满意，下次继续来购买，谢谢店家的热情招待！",
        "specification": "xl",
        "attribute": "黑色"
      },
      {
        "name": "sxy1006",
        "time": "2017-6-21",
        "cont": "很好",
        "specification": "xxxl",
        "attribute": "白色"
      }
    ],
    "goodsInfoCont": "旅游季包邮Crocs卡骆驰男女中性运动迪特洞洞鞋沙滩凉鞋|11991",
    "goodsdetailImg": "../../images/goods_1.jpg",

    parameteCont:[
      {
        "name":"款式",
        "value":"中长款"
      }
    ]

  },

  onLoad: function (options) {
    // 生命周期函数--监听页面加载
    var token = wx.getStorageSync('token')
    var that = this
    var goodsId = options.objectId;
    order.id = goodsId
    // console.log(order.id)
    //调用应用实例的方法获取全局数据
    wx.request({
      url: app.apiUrl("goods/detail"),
      data: {
        "id": goodsId,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },

      success: function (res) {
        that.setData({
          goodsImg: res.data.data.goods_img,
          goods: res.data.data.goods_info,
          properties: res.data.data.goods_properties.pro,
          collect: res.data.data.goods_info,
          shopName:res.data.data
          // goodsComment: res.data.data.comment.slice(0, 3)
          // goodsComment: res.data.data.comment.slice(0, 3)
        })
        //商品有属性则默认选中第一个
        for (var i in res.data.data.goods_properties.pro) {
          that.getProper(res.data.data.goods_properties.pro[i].values[0].id)
        }
        // if()
        that.getGoodsTotal();
      }
    })
    //加载中
    this.loadingChange()
  },
  onShow: function () {
    order.num = 1;
    order.pro = [];
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 1000)
  },
  /*提交*/
  goodsCheckout: function (e) {
    var token = wx.getStorageSync('token')
    // console.log(token)
    // console.log(order.id)
    wx.request({
      url: app.apiUrl("cart/add"),
      data: {
        "id": order.id,
        "num":order.num,
        "attr_id": JSON.stringify(tempOrderPro),
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        var result = res.data.data;
        // console.log(result)
        if (result == true && res.data.code == 0) {

          if (goodsbtn == 'cart') {
            //成功则跳转到购物确认页面
            wx.switchTab({
              url: '../flow/index'
            });
          } else {
            wx.redirectTo({
              url: '../flow/checkout'
            });
          }
        } else {
          //错误处理
          wx.showToast({
            title: '提交失败',
            icon: 'warn',
            duration: 2000
          })
        }
      }
    })
    //关闭弹框
    this.animation.translateY(285).step();
    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'hidden'
    });
  },

  //马上购买事件
  cascadePopup: function (e) {
    var animation = wx.createAnimation({
      duration: 100,
      timingFunction: 'ease-in-out'
    });
    this.animation = animation;
    animation.translateY(-450).step();

    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'show',

    })
    //获取id
    goodsbtn = e.currentTarget.id || 'cart'
    //console.log(goodsbtn)
  },
  //点击遮区域关闭弹窗
  cascadeDismiss: function () {
    this.animation.translateY(285).step();
    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'hidden'
    });
  },
  /*增加商品数量*/
  up: function () {
    var num = this.data.num;
    // console.log(num)
    num++;
    if (num >= 99) {
      num = 99
    }
    this.setData({
      num: num
    })
    order.num = num;
    this.getGoodsTotal();
  },
  /*减少商品数量*/
  down: function () {
    var num = this.data.num;
    num--;
    if (num <= 1) {
      num = 1
    }
    this.setData({
      num: num
    })
    order.num = num;
    this.getGoodsTotal();
  },
  /*手动输入商品*/
  import: function (e) {
    var num = Math.floor(e.detail.value);
    if (num <= 1) {
      num = 1
    }
    if (num >= 999) {
      num = 999
    }
    this.setData({
      num: num
    })
    order.num = num;
    this.getGoodsTotal();

  },
  /*单选*/
  modelTap: function (e) {
    this.getProper(e.currentTarget.id)
    this.getGoodsTotal();
  },
  /*属性选择计算*/
  getProper: function (id) {
    tempOrderPro = []
    tempOrderProStr = []
    var categoryList = this.data.properties;
    //console.log(categoryList)
    for (var index in categoryList) {
      for (var i in categoryList[index].values) {
        categoryList[index].values[i].checked = false;
        // console.log(categoryList[index].values[i].id)
        if (categoryList[index].values[i].id == id) {
          order.pro[categoryList[index].name] = id
          order.prostr[categoryList[index].name] = categoryList[index].values[i].label
        }
      }
    }

    //处理页面
    for (var index in categoryList) {
      if (order.pro[categoryList[index].name] != undefined && order.pro[categoryList[index].name] != '') {
        for (var i in categoryList[index].values) {
          if (categoryList[index].values[i].id == order.pro[categoryList[index].name]) {
            categoryList[index].values[i].checked = true;
          }
        }
      }
    }
    for (var l in order.pro) {
      tempOrderPro.push(order.pro[l]);
    }
    for (var n in order.prostr) {
      tempOrderProStr.push(order.prostr[n]);
    }

    this.setData({
      properties: categoryList,
      selectedPro: tempOrderProStr.join(',')
    });
  },
  getGoodsTotal: function () {
    //提交属性  更新价格
    var that = this;
    var token = wx.getStorageSync('token')
    wx.request({
      url: app.apiUrl("goods/property"),
      data: {
        id: order.id,
        attr_id: tempOrderPro,
        num: order.num,
        warehouse_id:"1",
        area_id: "1"
      },
      method: 'POST',
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        // console.log(res)
          that.setData({ 
            goods_price: res.data.data
            });
       
      }
    })
  },

  //头部菜单切换(商品 详情、评论)
  toNew: function () {
    //console.log('new');
    this.updateBtnStatus('new');
    wx.redirectTo({
      url: "../goods/index?objectId=" + order.id
    })
  },
  toGood: function () {
    //console.log('good');
    this.updateBtnStatus('good');
    wx.redirectTo({
      url: "../goods/detail?objectId=" + order.id
    })
  },
  toChild: function () {
    //console.log('child');
    this.updateBtnStatus('child');
    wx.redirectTo({
      url: "../goods/comment?objectId=" + order.id
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
  /*商品描述导航内容切换*/
  bindHeaderTap: function (event) {
    //console.dir("header")
    this.setData({
      current: event.target.dataset.index,
    });
    this.toggleShift()
  },
  bindSwiper: function (event) {
    this.setData({
      current: event.detail.current,
    });
    this.toggleShift()
  },
  toggleShift: function () {
    this.shiftanimation.left(shiftdata[this.data.current]).step()
    this.setData({
      shiftanimation: this.shiftanimation.export()
    })
  },
  flowCart: function () {
    wx.switchTab({
      url: '../flow/index'
    });
  },
  onShareAppMessage: function () {
    return {
      title: '商品详情',
      desc: '小程序本身无需下载，无需注册，不占用手机内存，可以跨平台使用，响应迅速，体验接近原生App',
      path: '/pages/goods/goods?objectId=' + order.id
    }
  },
  /*收藏*/
  addCollect: function () {
    var that = this;
    console.log(111)
    var token = wx.getStorageSync('token')
    console.log(order.id)
    wx.request({
      url: app.apiUrl("user/collect/add"),
      data: {
        "id": order.id,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
      }
    })
    wx.request({
      url: app.apiUrl("goods/detail"),
      data: {
        "id": order.id,
      },
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        var result = res.data.data.goods_info.is_collect;
        if (result == 1) {
          wx.showToast({
            title: '收藏成功',
            icon: 'warn',
            duration: 2000
          })
        } else {
          wx.showToast({
            title: '取消收藏',
            icon: 'warn',
            duration: 2000
          })
        }
        that.setData({
          collect: res.data.data.goods_info,
        })
      }
    })
  },
  setCurrent: function (e) {
    this.setData({
      currentIndex: e.detail.current + 1
    })
  },
  imgPreview: function () { //图片预览
    const imgs = this.data.goodsImg;
    wx.previewImage({
      current: imgs[this.data.currentIndex - 1], // 当前显示图片的http链接
      urls: imgs // 需要预览的图片http链接列表
    })
  },



})








