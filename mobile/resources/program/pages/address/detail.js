var app = getApp()


Page({

  data: {
    countrys: [],
    provinces: [],
    citys: [],
    districts: [],
    // 国
    countryList: [],
    countryIndex: 0,
    // 省
    provinceList: [],
    provinceIndex: 0,
    // 市
    cityList: [],
    cityIndex: 0,
    // 县
    districtList: [],
    districtIndex: 0,
    // 收货人信息
    consignee: '',
    mobile: '',
    address: '',
    addressData: [],
    countrys_id:"",
    province_id:""
  },

  onLoad: function (options) {
    var that = this
    var token = wx.getStorageSync('token')
    // 地区赋值
    var regions = wx.getStorageSync('regions') // 地区列表
    var addressData = wx.getStorageSync('addressData') // 个人资料
    console.log(addressData)

    var address_id = options.objectId;
    wx.request({
      url: app.apiUrl('user/address/detail'),
      data: { 
        id: address_id
         },
      method: 'POST',
      header: {
        'Content-Type': 'application/json',
        'X-ECTouch-Authorization': token
      },
      success: function (res) {
        
        console.log(res.data.data)
        that.setData({
          consignee: res.data.data.consignee,
          mobile: res.data.data.mobile,
          address: res.data.data.address,
          countrys_id: res.data.data.country_id
        })
      }
    })
    wx.request({
      url: app.apiUrl('region/list'),
      method: 'POST', // OPTIONS, GET, HEAD, POST, PUT, DELETE, TRACE, CONNECT
      data: { id: that.data.countrys_id},
      success: function (res) {
        console.log(res.data.data.region_id)
        that.setData({
          countryList: res.data.data
        });
      }

    })
    //加载中
    that.loadingChange()
  },
  loadingChange() {
    setTimeout(() => {
      this.setData({
        hidden: true
      })
    }, 2000)
  },
  // 国
  countryTypeChange: function (e) {
    var that = this, index = e.detail.value
    that.data.addressData['country_id'] = that.data.countryList[index].region_id;
    wx.request({
      url: app.apiUrl('region/list'),
      data: { id: that.data.countryList[index].region_id },
      method: 'POST',

      success: function (res) {
        that.setData({
          countryIndex: index,
          provinceList: res.data.data,
          provinceIndex: 0,
          cityIndex: 0,
          districtIndex: 0
        })
      }
    })

  },
  //省
  provinceTypeChange: function (e) {
    var that = this, index = e.detail.value

    that.data.addressData['province_id'] = that.data.provinceList[index].region_id;
    wx.request({
      url: app.apiUrl('region/list'),
      data: { id: that.data.provinceList[index].region_id },
      method: 'POST',
      success: function (res) {
        that.setData({
          provinceIndex: index,
          cityList: res.data.data,
          cityIndex: 0,
          districtIndex: 0
        })
      }
    })

  },
  //市
  cityTypeChange: function (e) {
    var that = this, index = e.detail.value
    that.data.addressData['city_id'] = that.data.cityList[index].region_id;
    wx.request({
      url: app.apiUrl('region/list'),
      data: { id: that.data.cityList[index].region_id },
      method: 'POST',
      success: function (res) {
        that.setData({
          cityIndex: index,
          districtList: res.data.data,
          districtIndex: 0
        })
      }
    })


  },
  //区
  districtTypeChange: function (e) {
    // console.log('picker发送选择改变，携带值为', e.detail.value)
    var that = this, index = e.detail.value
    that.data.addressData['district_id'] = that.data.districtList[index].region_id;
    that.setData({
      districtIndex: index

    })
  },



  saveData: function (e) {
    var that = this
    var data = e.detail.value;
    var region_id = 0;
    if (that.data.districts.length > 0) {
      var districtsIndex = parseInt(data.district) - 1
      region_id = that.data.districts[districtsIndex].region_id;
    }

    var postdata = {
      consignee: data.consignee,
      country: that.data.addressData['country_id'],
      province: that.data.addressData['province_id'],
      city: that.data.addressData['city_id'],
      district: that.data.addressData['district_id'],
      address: data.address,
      mobile: data.mobile,
      id: that.data.addressData.address_id,
    }

    var token = wx.getStorageSync('token')

    wx.request({
      url: app.apiUrl('user/address/update'),
      method: 'post',
      header: {
        'X-ECTouch-Authorization': token
      },
      data: postdata,
      success: function (res) {
        var result = res.data
        if (result.error_code > 0) {
          for (var i in result.error_desc) {
            wx.showModal({ title: result.error_desc[i][0] })
            break
          }
          return false;
        }

        wx.showToast({
          title: '保存成功',
          duration: 2000,
          success: function () {
            wx.redirectTo({ url: './index' })
          }
        })
      }
    })
  },
  //下拉刷新完后关闭
  onPullDownRefresh: function () {
    wx.stopPullDownRefresh()
  },
})
