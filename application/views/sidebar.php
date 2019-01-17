
<?php
		if(isset($_SESSION['PageActive']))
		{
			$PageActive 	= 	$_SESSION['PageActive'];
			unset($_SESSION['PageActive']);
		}
		else
		{
			$PageActive 	= 	'dashboard';
		}

		if(isset($_SESSION['SubActive']))
		{
			$SubActive 	= 	$_SESSION['SubActive'];
			unset($_SESSION['SubActive']);
		}
		else
		{
			$SubActive 	= 	'';
		}
		
?>

<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>

				<li>
					<a href="<?php echo base_url(); ?>" <?php echo ($PageActive == 'dashboard')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-home mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li>

				
				


				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#order_dr" <?php echo ($PageActive == 'order')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-shopping-cart mr-20"></i><span class="right-nav-text">Order</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="order_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'order/add';?>" <?php echo ($SubActive == 'add_order')?'class="active-page"':'';?>>New Order</a>
						</li>
						<li>
							<a href="<?php echo base_url().'order';?>" <?php echo ($SubActive == 'list_order')?'class="active-page"':'';?> >List Order</a>
						</li>

						<li>
							<a href="<?php echo base_url().'order/completed';?>" <?php echo ($SubActive == 'complete_order')?'class="active-page"':'';?> >Completed</a>
						</li>
						
						
					</ul>
				</li>


				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#order_manage_dr" <?php echo ($PageActive == 'order_manage')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Order Manage</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="order_manage_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'order_manage';?>" <?php echo ($SubActive == 'list_order_manage')?'class="active-page"':'';?> >List</a>
						</li>

						<li>
							<a href="<?php echo base_url().'order_manage/stiching';?>" <?php echo ($SubActive == 'stiching_order')?'class="active-page"':'';?> >Stiching</a>
						</li>

						<li>
							<a href="<?php echo base_url().'order_manage/ready';?>" <?php echo ($SubActive == 'ready_order')?'class="active-page"':'';?> >Ready</a>
						</li>

						<li>
							<a href="<?php echo base_url().'order_manage/completed';?>" <?php echo ($SubActive == 'delivered_order')?'class="active-page"':'';?> >Completed</a>
						</li>
						
						
					</ul>
				</li>

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#sales_dr" <?php echo ($PageActive == 'sale')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-shopping-basket mr-20"></i><span class="right-nav-text">Sales</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="sales_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'sale/add';?>" <?php echo ($SubActive == 'add_sale')?'class="active-page"':'';?>>New Sale</a>
						</li>
						<li>
							<a href="<?php echo base_url().'sale';?>" <?php echo ($SubActive == 'list_sale')?'class="active-page"':'';?>>List Sales</a>
						</li>
						<li>
							<a href="#">Sales Retrun</a>
						</li>
						
					</ul>
				</li>

				<li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#purchse_dr" <?php echo ($PageActive == 'purchase')?'class="active-page"':'';?>>
                        <div class="pull-left"><i class="fa fa-shopping-bag mr-20"></i><span class="right-nav-text">Purchase</span></div><div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="purchse_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url().'purchase/add';?>" <?php echo ($SubActive == 'add_purchase')?'class="active-page"':'';?>">New Purchase</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'purchase';?>" <?php echo ($SubActive == 'list_purchase')?'class="active-page"':'';?>">List Purchase</a>
                        </li>
                        <li>
                            <a href="#">Purchase Retrun</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#expense_dr" <?php echo ($PageActive == 'expense')?'class="active-page"':'';?>>
                        <div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Expense</span></div><div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="expense_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url().'salary';?>" <?php echo ($SubActive == 'list_salary')?'class="active-page"':'';?>">Staff Salary</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'expense';?>" <?php echo ($SubActive == 'list_expense')?'class="active-page"':'';?>">Other Expense</a>
                        </li>


                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#equity_dr" <?php echo ($PageActive == 'equity')?'class="active-page"':'';?>>
                        <div class="pull-left"><i class="fa fa-bank mr-20"></i><span class="right-nav-text">Equity</span></div><div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="equity_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url().'equity/capital';?>" <?php echo ($SubActive == 'capital')?'class="active-page"':'';?>">Captal Amount</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'equity/withdraw';?>" <?php echo ($SubActive == 'withdraw')?'class="active-page"':'';?>">Withdraw</a>
                        </li>


                    </ul>
                </li>

				

				
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>component</span> 
					<i class="zmdi zmdi-more"></i>
				</li>


				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#service_dr" <?php echo ($PageActive == 'service')?'class="active-page"':'';?>>
						<div class="pull-left" <?php echo ($PageActive == 'service')?'class="active-page"':'';?>>
						<i class="fa fa-female mr-20"></i><span class="right-nav-text">Service</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="service_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'service/add';?>" <?php echo ($SubActive == 'add_service')?'class="active-page"':'';?>>
							Add Service</a>
						</li>
						<li>
							<a href="<?php echo base_url().'service';?>" <?php echo ($SubActive == 'list_service')?'class="active-page"':'';?>>
							List Service</a>
						</li>
						<li>
							<a href="<?php echo base_url().'design/add';?>"  <?php echo ($SubActive == 'add_design')?'class="active-page"':'';?>>
							Add Design</a>
						</li>

						<li>
							<a href="<?php echo base_url().'design';?>" <?php echo ($SubActive == 'list_design')?'class="active-page"':'';?>>
							List Design</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#product_dr" <?php echo ($PageActive == 'product')?'class="active-page"':'';?> >
						<div class="pull-left"><i class="fa fa-flask mr-20"></i><span class="right-nav-text">Product</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="product_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'product/add';?>" <?php echo ($SubActive == 'add_product')?'class="active-page"':'';?>>
							Add Product</a>
						</li>
						<li>
							<a href="<?php echo base_url().'product';?>" <?php echo ($SubActive == 'list_product')?'class="active-page"':'';?>>
							List Product</a>
						</li>
				
						<li>
							<a href="<?php echo base_url().'category';?>" <?php echo ($SubActive == 'category')?'class="active-page"':'';?>>
							Category</a>
						</li>

						<li>
							<a href="<?php echo base_url().'units';?>" <?php echo ($SubActive == 'units')?'class="active-page"':'';?>>
							Units</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="<?php echo base_url().'customer';?>" 
						<?php echo ($PageActive == 'customer')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa  fa-group mr-20"></i><span class="right-nav-text">Customers</span></div><div class="clearfix"></div></a>
				</li>

				

				<li>
					<a href="<?php echo base_url().'supplier';?>" 
						<?php echo ($PageActive == 'supplier')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-truck mr-20"></i><span class="right-nav-text">Supplier</span></div><div class="clearfix"></div></a>
				</li>

				<li>
					<a href="<?php echo base_url().'staff';?>" 
						<?php echo ($PageActive == 'staff')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-user mr-20"></i><span class="right-nav-text">Staffs</span></div><div class="clearfix"></div></a>
				</li>

				<li>
					<a href="<?php echo base_url().'tax'; ?>" <?php echo ($PageActive == 'tax')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Tax</span></div><div class="clearfix"></div></a>
				</li>


				<li>
					<a href="<?php echo base_url().'warehouse';?>" 
						<?php echo ($PageActive == 'warehouse')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-codepen mr-20"></i><span class="right-nav-text">Warehouse</span></div><div class="clearfix"></div></a>
				</li>

				<li>
					<a href="<?php echo base_url().'manufacture';?>" 
						<?php echo ($PageActive == 'manufacture')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-medkit mr-20"></i><span class="right-nav-text">Manufacture</span></div><div class="clearfix"></div></a>
				</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts_dr" <?php echo ($PageActive == 'accounts')?'class="active-page"':'';?> >
                        <div class="pull-left"><i class="fa fa-book mr-20"></i><span class="right-nav-text">Accounts</span></div><div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                    <ul id="accounts_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="<?php echo base_url().'accounts';?>" <?php echo ($SubActive == 'list_accounts')?'class="active-page"':'';?>>
                               Account List</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'accounts/transfer_list';?>" <?php echo ($SubActive == 'transfer')?'class="active-page"':'';?>>
                               Tranfer</a>
                        </li>



                    </ul>
                </li>

				


				
				

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>C Panel</span> 
					<i class="zmdi zmdi-more"></i>
				</li>

				

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#StockDr" <?php echo ($PageActive == 'reports')?'class="active-page"':'';?> >
						<div class="pull-left"><i class="fa fa-sort-alpha-asc mr-20"></i><span class="right-nav-text">Reports</span></div><div class="pull-right">
					<i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="StockDr" class="collapse collapse-level-1">
						<li>
							<a href="<?php echo base_url().'report/trial_balance';?>" <?php echo ($SubActive == 'trial_balance')?'class="active-page"':'';?>>
							Trial Balance</a>
						</li>


                        <li>
                            <a href="<?php echo base_url().'report/stock_list';?>" <?php echo ($SubActive == 'stock_list')?'class="active-page"':'';?>>
                                List Stock</a>
                        </li>
						

					</ul>
				</li>

				<li>
					<a href="#" <?php echo ($PageActive == 'backup')?'class="active-page"':'';?>>
						<div class="pull-left"><i class="fa fa-database mr-20"></i><span class="right-nav-text">Backup</span></div><div class="clearfix"></div></a>
				</li>
				
			</ul>
		</div>