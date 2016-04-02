<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
          <img src="<?php echo base_url('assets/img/avatars/male.png'); ?>" alt="me" class="online" />
          <span>
            <?php
              echo $this->session->userdata('firstName') . " " . $this->session->userdata('lastName');
             ?>
          </span>
        <i class="fa fa-angle-down"></i>
        </a>

        </span>
    </div>
    <!-- end user info -->
    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
			<li <?php if($page == "dashboard") echo 'class="active"'; ?>>
                <a href="<?php echo base_url('home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Configurações</span></a>
                <ul>
                    <li <?php if($page == "estrutura") echo 'class="active"'; ?>>
                        <a href="<?php echo base_url('configuracoes/estrutura'); ?>"><i class="fa fa-lg fa-fw fa-cog"></i>Estrutura</a>
                    </li>
					<li <?php if($page == "perfis") echo 'class="active"'; ?>>
                        <a href="<?php echo base_url('configuracoes/perfis'); ?>"><i class="fa fa-lg fa-fw fa-cog"></i>Perfis</a>
                    </li>
					<li <?php if($page == "utilizadores") echo 'class="active"'; ?>>
                        <a href="<?php echo base_url('configuracoes/utilizadores'); ?>"><i class="fa fa-lg fa-fw fa-user"></i>Utilizadores</a>
                    </li>
					<li <?php if($page == "logs") echo 'class="active"'; ?>>
						<a href="<?php echo base_url('configuracoes/logs'); ?>"><i class="fa fa-lg fa-fw fa-book "></i>Logs</a>
					</li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('bombeiros'); ?>"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Bombeiros</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-ambulance"></i> <span class="menu-item-parent">Veículos</span></a>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>
<!-- END NAVIGATION -->