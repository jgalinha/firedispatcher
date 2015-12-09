<!-- Left panel : Navigation area -->
  <!-- Note: This width of the aside area can be adjusted through LESS variables -->
  <aside id="left-panel">

      <!-- User info -->
      <div class="login-info">
          <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
          <img src="<?php echo base_url('assets/img/avatars/sunny.png'); ?>" alt="me" class="online" />
          <span>
            <?php
              
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
              <li class="active">
                  <a href="<?php echo base_url('home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
              </li>
              <li>
                  <a href="inbox.html"><i class="fa fa-lg fa-fw fa-fire"></i> <span class="menu-item-parent">Bombeiros</span></a>
              </li>
          </ul>
      </nav>
      <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
    </span>

  </aside>
  <!-- END NAVIGATION -->
