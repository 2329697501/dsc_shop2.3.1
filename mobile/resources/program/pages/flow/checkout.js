var WxParse = require('../../wxParse/wxParse.js');
var app = getApp()
var token

var order = {
  consignee: 1,
  shipping_list: 1,
  msg: ''
}
var cart_goods_list;
var order_total;
var currentTarget
Page({
  data: {
    shop_id:'0',
    index: 0,
    orderJtou: '../../res/images/icon-arrowdown.png',
    addresss_link: '../address/index?from=flow',
    checkList: [],
    shipping_id:0
  },
  onShow: function (options) {
    token = wx.getStorageSync('token')
    var that = this
    wx.request({
      url: app.apiUrl("flow"),
      method: "post",
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        // if (res.data[400] != undefined) {
        //   wx.switchTab({
        //     url: '../categroy/categroy'
        //   })
        //   return
        // }
        // if (res.data.data.cart_goods_list.list[0].length == 0) {
        //   wx.switchTab({
        //     url: '../categroy/categroy'
        //   })
        //   return
        // }
        order.consignee = res.data.data.default_address.address_id
        // console.log(order.consignee)
        var ship = {
          id: [],
          name: [],
        }
        for (var i in res.data.data.shipping_list) {
          ship.id.push(res.data.data.shipping_list[i].shipping_id)
          ship.name.push(res.data.data.shipping_list[i].shipping_name)
        }

        cart_goods_list = res.data.data.cart_goods_list.list
        var attr;
        var temp = '';
        for (var i in res.data.cart_goods_list) {
          attr = res.data.cart_goods_list.list[0][i].goods_attr.split('\n')
          for (var j in attr) {
            if (attr[j] == '') continue;
            temp += attr[j] + ','
          }
          res.data.cart_goods_list.list[0][i].goods_attr = temp.substring(0, temp.length - 1)
        }
        order_total = WxParse.wxParse('order_total', 'html', res.data.data.cart_goods_list.order_total, that, 5),
        // console.log(order_total)
        that.setData({
          shopLists: res.data.data.cart_goods_list,
          shopTotal: res.data.data.cart_goods_list,
          addresss: res.data.data.default_address,
          totals: res.data.data.cart_goods_list.total,
          order_total: WxParse.wxParse('order_total', 'html', res.data.data.cart_goods_list.order_total, that, 5),
          shipping_list: ship,
          shop_id: res.data.data.cart_goods_list.list,

        })
        that.shippingChange()
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
    }, 2000)
  },

  //配送方式
  shippingChange: function (e) {
    var that = this

    var shipping_index =0

    var shipping_index_2 = 0

    if (e != undefined) {
      shipping_index = e.detail.value
      shipping_index_2 = e.detail.value
    }

    if (e == undefined) {
      return
    }
    order.shipping_list = this.data.shipping_list.id[shipping_index]
    this.setData({
      index_data: shipping_index,
      index_data_2: shipping_index_2,
    })

    var shop_id = that.data.shop_id[e.currentTarget.dataset.index][0].ru_id
    wx.request({
      url: app.apiUrl('flow/shipping '),
      data: {
        address: order.consignee,
        ru_id: shop_id,
        id: order.shipping_list
      },
      method: 'POST',
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        // if (res.data.error == 0){
        //   wx.showToast({
        //         title: '该地区不支持配送',
        //         icon: 'warn',
        //         duration: 2000
        //       })
        // }
        if (res.data == false) {
          that.setData({
            payfee: '',
            total: order_total
          })
          return
        }
        if (parseInt(res.data) >= 0) {
          that.setData({
            payfee: res.data,
            payname: that.data.shipping.name[shipping_index],
            total: order_total + parseInt(res.data)
          })
        }
      }
    })

  },

  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    wx.stopPullDownRefresh()
  },
  siteDetail: function (e) {
    var that = this
    //获取点击的id值
    var index = e.currentTarget.dataset.index;
    var goodsId = that.data.data.checkList[index].goods_id;

    wx.navigateTo({
      url: "../goods/goods?objectId=" + goodsId
    });
  },
  //提交订单
  submitOrder: function () {

    if (order.consignee == '' || order.consignee == undefined) {
      app.shwomessage('没有收货地址');
      return;
    }
    wx.request({
      url: app.apiUrl('flow/down'),
      method: "post",
      data: {
        consignee: 1,
        // consignee: order.address_list,
        shipping: order.shipping_list,
      },
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        console.log(222)
        console.log(res)
        var oid = res.data.data
        console.log(oid)
        if (oid != '') {
          wx.redirectTo({
            url: '../flow/done?id=' + oid
          })
        }

      }
    })
    //
  },
  // getmsg: function (e) {
  //   order.msg = e.detail.value
  // },
})