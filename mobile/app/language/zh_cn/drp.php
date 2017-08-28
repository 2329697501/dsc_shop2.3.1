<?php

/**
 * ECTouch Open Source Project
 * ============================================================================
 * Copyright (c) 2015-2016 http://ectouch.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：drp.php
 * ----------------------------------------------------------------------------
 * 功能描述：微分销语言
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

$_LANG['drp_separate_info'] = '用户ID %s ( %s ), 分成:佣金 %s';

$_LANG['separate_account_log'] = '订单号 %s, 分成:金钱 %s 抵用券 %s';
$_LANG['transferred_to_balance'] = '用户 %s, 分销分成转到余额:金钱 %s 抵用券 %s';
$_LANG['sch_order'] = '搜索订单号';

//分销订单状态
$_LANG['order_stats'][0] = '未确认';
$_LANG['order_stats'][1] = '已确认';
$_LANG['order_stats'][2] = '已取消';
$_LANG['order_stats'][3] = '无效';
$_LANG['order_stats'][4] = '退货';
$_LANG['order_stats'][5] = '已分单';
//分销订单操作状态
$_LANG['sch_stats'][0] = '等待处理';
$_LANG['sch_stats'][1] = '已分成';
$_LANG['sch_stats'][2] = '取消分成';
$_LANG['sch_stats'][3] = '已撤销';
$_LANG['sch_stats']['all'] = '全部';

//分销操作
$_LANG['drp_affiliate_separate'] = '分成';
$_LANG['drp_affiliate_cancel'] = '取消';
$_LANG['drp_affiliate_rollback'] = '撤销';
$_LANG['drp_affiliate_batch'] = '批量分成';


$_LANG['drp_action'] = '操作信息';
$_LANG['order_sn'] = '订单号';
$_LANG['order_stats']['name'] = '订单状态';
$_LANG['log_info'] = '操作信息';
$_LANG['sch_stats']['name'] = '操作状态';
$_LANG['drp_ru_name'] = '订单归属商家';

$_LANG['loginfo_cancel'] = '分成被管理员取消！';

//分销转出
$_LANG['transferred_title'] = '分销佣金转出';
$_LANG['transferred_how'] = '转入余额';
$_LANG['transferred_error'] = '您要申请转出的佣金超过了您现有的佣金，此操作将不可进行!';
$_LANG['amount_gt_zero'] = '转出佣金小于最低可提现金额';
$_LANG['back_page_up'] = '返回上一页';
$_LANG['drp_money_submit'] = '您的分销佣金已经转出到余额!';
$_LANG['back_drp_center'] = '返回分销中心';


//admin/shop/user
$_LANG['request_error'] = '错误的请求';
$_LANG['edit_success'] = '修改成功';
$_LANG['select_shop'] = '请选择店铺';
$_LANG['select_start_end_time'] = '请选择导出的开始时间和结束时间';
$_LANG['start_lt_end_time'] = '开始时间不能大于结束时间';
$_LANG['shop_number'] = '编号';
$_LANG['shop_name'] = '店铺名';
$_LANG['rely_name'] = '真实姓名';
$_LANG['mobile'] = '手机号码';
$_LANG['open_time'] = '开店时间';
$_LANG['shop_audit'] = '店铺是否审核（1为已审核，0为未审核）';
$_LANG['shop_state'] = '店铺状态（1为开启，0为关闭）';
$_LANG['qq_number'] = 'QQ号';
$_LANG['msg_mobile_format_error'] = '手机号码格式不正确';
$_LANG['mobile_not_null'] = '手机号码不能为空';
$_LANG['msg_shop_name_notnull'] = '店铺名称不能为空';
$_LANG['msg_name_notnull'] = '真实姓名称不能为空';
$_LANG['msg_contact_way_notnull'] = '联系方式不能为空';
$_LANG['add_error'] = '添加失败';
$_LANG['open_shop_process'] = '开店流程';
$_LANG['category_not_null'] = '分类不能为空';
$_LANG['set_up_shop'] = '开店完成';
$_LANG['distribution_application'] = '购买分销申请';
$_LANG['admin_check'] = '请等待管理员审核';
$_LANG['in_shop'] = '进入商城';
$_LANG['shop_close'] = '店铺还未开启!';
$_LANG['brokerage_list'] = '佣金明细';
$_LANG['all_category'] =  '全部分类';
$_LANG['my_team'] = '我的团队';
$_LANG['team_detail'] = '团队详情';
$_LANG['must_be_read'] = '新手必看';
$_LANG['distribution_Ranking'] = '分销排行';
$_LANG['mgs_shop_name_notnull'] = '店铺名不能为空';
$_LANG['shop_set'] = '店铺设置';
$_LANG['distribution_order'] = '分销订单';
$_LANG['distribution_order_list'] = '分销订单详情';

return $_LANG;
