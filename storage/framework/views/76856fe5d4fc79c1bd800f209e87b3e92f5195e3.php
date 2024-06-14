<?php
    // $logo=asset(Storage::url(''));
    $company_logo = \App\Models\Utility::GetLogo();
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $users = \Auth::user();
    $bussiness_id='';
    $bussiness_id = $users->current_business;
?>


<!-- [ navigation menu ] start -->

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar">
<?php endif; ?>

<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="#" class="b-brand">
            <?php if($setting['cust_darklayout'] == 'on'): ?>
                <img src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png').'?'.time()); ?>"
                    alt="" class="img-fluid" />
            <?php else: ?>
                <img src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png').'?'.time()); ?>"
                    alt="" class="img-fluid" />
            <?php endif; ?>
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">
            <li
                class="dash-item <?php echo e(Request::segment(1) == 'home' || Request::segment(1) == '' || Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('home')); ?>" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>

            </li>
            <li class="dash-item dash-hasmenu">
                <a class="dash-link <?php echo e(Request::segment(1) == 'new_business' || Request::segment(1) == 'business' ? 'active' : ''); ?>"
                    data-toggle="collapse" role="button"
                    aria-expanded="<?php echo e(Request::segment(1) == 'new_business' || Request::segment(1) == 'business' ? 'true' : 'false'); ?>"
                    aria-controls="navbar-getting-started"><span class="dash-micon"><i
                            class="ti ti-credit-card"></i></span><span class="dash-mtext"><?php echo e(__('Versecard')); ?></span><span
                        class="dash-arrow"><i data-feather="chevron-right"></i></span>
                </a>
                <ul class="dash-submenu">
                    <?php if(\Auth::user()->can('create business')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'new_business' ? 'active' : ''); ?>">
                            <a href="#" class="dash-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-url="<?php echo e(route('business.create')); ?>" data-size="xl"
                                data-bs-whatever="<?php echo e(__('Create Versecard')); ?>"> <?php echo e(__('Create Versecard')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(\Auth::user()->can('manage business')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'business' ? 'active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('business.index')); ?>"><?php echo e(__('Manage Versecard')); ?></a>

                        </li>
                    <?php endif; ?>
                </ul>
            </li>
			<?php if(\Auth::user()->can('manage contact')): ?>
                <li class="dash-item <?php echo e(Request::segment(1) == 'contacts' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('contacts.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-phone"></i></span><span class="dash-mtext"><?php echo e(__('Contacts')); ?></span></a>

                </li>
            <?php endif; ?>
			<?php if(\Auth::user()->can('manage contact')): ?>
                
				<li class="dash-item <?php echo e(Request::segment(1) == 'leadcampaign' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('campaign.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-phone"></i></span><span class="dash-mtext"><?php echo e(__('Leads Campaign')); ?></span></a>

                </li>
            <?php endif; ?>
			
            <li class="dash-item dash-hasmenu">
					<?php if(Gate::check('manage user')): ?>
                <a class="dash-link <?php echo e(Request::segment(1) == 'employee' || Request::segment(1) == 'client' ? 'active' : ''); ?>"
                    data-toggle="collapse" role="button"
                    aria-expanded="<?php echo e(Request::segment(1) == 'employee' || Request::segment(1) == 'client' ? 'true' : 'false'); ?>"
                    aria-controls="navbar-getting-started"><span class="dash-micon"><i
                            class="ti ti-users"></i></span><span class="dash-mtext"><?php echo e(__('Staff')); ?></span><span
                        class="dash-arrow"><i data-feather="chevron-right"></i></span>
                </a>
				<?php endif; ?>
                <ul class="dash-submenu">
                    <?php if(Gate::check('manage user')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'users' ? 'active open' : ''); ?>">
                            <a class="dash-link"
                                <?php echo e(Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' ? ' active' : ''); ?>

                                href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->type == 'company'): ?>
                        <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'roles' ? 'active open' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Roles')); ?></a>
                        </li>
                    <?php endif; ?>

                </ul>
            </li>

            <?php if(\Auth::user()->can('manage appointment')): ?>
                <li class="dash-item <?php echo e(Request::segment(1) == 'appointments' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('appointments.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar-time"></i></span><span
                            class="dash-mtext"><?php echo e(__('Appointments')); ?></span></a>

                </li>
            <?php endif; ?>
            
            <?php if(\Auth::user()->can('calendar appointment')): ?>
                <li class="dash-item <?php echo e(Request::segment(1) == 'appointment-calendar' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('appointment.calendar')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar"></i></span><span
                            class="dash-mtext"><?php echo e(__('Calendar')); ?></span></a>

                </li>
				<li class="dash-item <?php echo e(Request::segment(1) == 'tap-history' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('loadTaps')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar"></i></span><span
                            class="dash-mtext"><?php echo e(__('NFC History')); ?></span></a>

                </li>
            <?php endif; ?>
            <?php if(\Auth::user()->can('manage email template')): ?>
                <li class="dash-item <?php echo e(Request::segment(1) == 'email_template_lang' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('manage.email.language', \Auth::user()->lang)); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-mail"></i></span><span
                            class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                </li>
            <?php endif; ?>
            <?php if(\Auth::user()->can('manage company setting')): ?>
                <li class="dash-item <?php echo e(Request::segment(1) == 'systems' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('systems.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span
                            class="dash-mtext"><?php echo e(__('Settings')); ?></span></a>

                </li>
            <?php endif; ?>
			
                <li class="dash-item <?php echo e(Request::segment(1) == '2faVerify' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('show2faForm')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span
                            class="dash-mtext"><?php echo e(__('Multi FA')); ?></span></a>

                </li>
				
				<li class="dash-item <?php echo e(Request::segment(1) == 'profile' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('profile')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-user"></i></span><span
                            class="dash-mtext"><?php echo e(__('Profile')); ?></span></a>

                </li>
				<li class="dash-item <?php echo e(Request::segment(1) == 'logout' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('logout')); ?>" class="dash-link" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><span class="dash-micon"><i
                                class="ti ti-power"></i></span><span
                            class="dash-mtext"><?php echo e(__('Logout')); ?></span></a>
					<form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo e(csrf_field()); ?>

                    </form>

                </li>
				
          
        </ul>
    </div>
</div>
</nav>
<!-- [ navigation menu ] end -->
<?php /**PATH /home/oseghale/Downloads/VerseCard-main/resources/views/partials/admin/sidemenu.blade.php ENDPATH**/ ?>