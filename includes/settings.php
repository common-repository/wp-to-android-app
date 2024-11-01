<?php 
class WPtoAndroidSettings {
	private $wptonativeandroidsettings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wptonativeandroidsettings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wptonativeandroidsettings_page_init' ) );
	}

	public function wptonativeandroidsettings_add_plugin_page() {
		add_menu_page(
			'Build Android App', // page_title
			'Build Android App', // menu_title
			'manage_options', // capability
			'wptonativeandroid', // menu_slug
			array( $this, 'wptonativeandroidsettings_create_admin_page' ), // function
			'dashicons-admin-settings', // icon_url
			3 // position
		);
		add_submenu_page( 'wptonativeandroid', 'Help & About', 'Help & About',
    'manage_options', 'wptonativeandroid-help',array( $this, 'wptonativeandroidsettings_create_help_page' ));
	
    
	}

/* Setting Page */ 
	
	public function wptonativeandroidsettings_create_help_page() {
		?>
		<center><p><strong><h3>
			About
			</h3></strong></p>
			<p>
				<img width="150px" src="<?php echo plugin_dir_url( __DIR__ ); ?>/images/logo.png">
			</p>
       <p>WordPress to Android is Developed by <a target="_blank" href="http://kites.dev/">Kites.Dev</a></p>
		
			
<p><strong><h3>
			Support
			</h3></strong></p>
			<p>
			  Face any issue about the plugin? or need a custom modification? <br/>
             Feel free to contact with us. We also can help you to develop custom Android & iOS app for you. <br/>
			</p>
			<p>
				Mail us: connectspotlightstudio@gmail.com <br/>
				Also you can send a message using a  <a target="_blank" href="http://kites.dev/contacts/">contact form here</a>

			</p>
</center>
<?php
	}

	public function wptonativeandroidsettings_create_admin_page() {
		$this->wptonativeandroidsettings_options = get_option( 'wptonativeandroidsettings_option_name' ); ?>

		<div class="wrap">
			<h2>WPP Settings</h2>
			<p></p>
			<?php 
			$wptonativeandroidsettings_options = get_option( 'wptonativeandroidsettings_option_name' );
				if(empty($wptonativeandroidsettings_options['app_name'])){
			?>
			
			<div class="error notice">
    <p>Please Fill all info bellow and click on the Build app button</p>
</div>
<?php } else {
    $app_status_update = wp_remote_get("http://appbuilder.kites.dev?site=".get_site_url()."&admin_email=".get_option('admin_email'));
	if ( is_wp_error( $app_status_update ) ) {
   echo 'There be errors, yo!';
} else {
   $body = wp_remote_retrieve_body( $app_status_update );
   echo $body;
		
}
    ?>
    
    
    <?php
}
			settings_errors();
			
			
			?>
           <div class="wptonativeandroidsettings_flex">
			<form method="post" action="options.php">
				<?php
					settings_fields( 'wptonativeandroidsettings_option_group' );
					do_settings_sections( 'wpp-settings-admin' );
						if(empty($wptonativeandroidsettings_options['app_name'])){
						    	submit_button("Build App");
						}
						else {
						   	submit_button("Update App"); 
						}
				
				?>
       <div class="pro_banner">
        <div class="pro_title">
			Try Our Premium Service
		   </div> 
        <ul>
			<li>Faster & Multiple Build Support</li>
            <li>Monitization Support</li>
            <li>Firebase & Google Analytics Support</li>
            <li>Many More.....</li>
		   </ul>
		   <a href="https://api.whatsapp.com/send?phone=+8801701083245">Whatsapp Us</a>
				</div>
			</form>
			<?php 
		
			if(empty($wptonativeandroidsettings_options['app_name'])){
			    $appname = get_bloginfo( 'name' );
			}
			else {
			    $appname = $wptonativeandroidsettings_options['app_name'];
			}
			
				if(empty($wptonativeandroidsettings_options['featured_text'])){
			    $featured_text = "Featured";
			}
			else {
			    $featured_text = $wptonativeandroidsettings_options['featured_text'];
			}
			
			
				if(empty($wptonativeandroidsettings_options['latest_text'])){
			    $latest_text = "Latest";
			}
			else {
			    $latest_text = $wptonativeandroidsettings_options['latest_text'];
			}
			
			
				if(empty($wptonativeandroidsettings_options['showall_text'])){
			    $all_text = "Show All";
			}
			else {
			    $all_text = $wptonativeandroidsettings_options['showall_text'];
			}
			
			if(empty($wptonativeandroidsettings_options['tab1_text'])){
			    $tab1 = "Home";
			}
			else {
			    $tab1 = $wptonativeandroidsettings_options['tab1_text'];
			}


if(empty($wptonativeandroidsettings_options['tab2_text'])){
			    $tab2 = "Categories";
			}
			else {
			    $tab2 = $wptonativeandroidsettings_options['tab2_text'];
			}


if(empty($wptonativeandroidsettings_options['tab3_text'])){
			    $tab3 = "Search";
			}
			else {
			    $tab3 = $wptonativeandroidsettings_options['tab3_text'];
			}
			
			$brand_color = $wptonativeandroidsettings_options['brand_color'];
			?>
			<div class="wptonativeandroidsettings_preview">
			    
			    <div id="frame">
        <div id="innerFrame">
            <div id="top-gadgets">
                <div class="front-camera"></div>
                <div class="front-speaker"></div>
                <div class="light-sensor"></div>
            </div>
            <div id="screen">
                <div class="wpna_title">
                    <?php echo $appname; ?>
                </div>
                <div class="featured_area">
                    
                    <div class="featured_text" id="f_change_preview">
                        <?php echo $featured_text; ?>
                    </div>
                    <div class="featured_btn">
                        <button type="button"><?php echo $all_text; ?></button>
                    </div>
                </div>
                <img class="f_image" src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/slider.png">
                
                <div class="featured_area">
                    
                    <div class="featured_text" id="l_change_preview">
                        <?php echo $latest_text; ?>
                    </div>
                    <div class="featured_btn">
                        <button type="button"><?php echo $all_text; ?></button>
                    </div>
                </div>
                
                 <img class="f_image" src="<?php echo plugin_dir_url( __FILE__ ); ?>/images/list.png">
                
                <div class="bottom_menu">
                    <div class="icon_menu" style="color:<?php echo $brand_color; ?>" id="active_color">
                        <div class="icon"><span class="dashicons dashicons-admin-home"></span></div>
                         <div class="text" id="tab1"><?php echo $tab1; ?></div>
                    </div>
                    
                     <div class="icon_menu">
                        <div class="icon"><span class="dashicons dashicons-category"></span></div>
                         <div class="text" id="tab2"><?php echo $tab2; ?></div>
                    </div>

               <div class="icon_menu">
                        <div class="icon"><span class="dashicons dashicons-search"></span></div>
                         <div class="text" id="tab3"><?php echo $tab3; ?></div>
                    </div>
                    
                </div>
                
            </div>
            <div id="touch-buttons">
                <div id="option-button">
                    
                </div>
                <div id="home-button">
                    
                </div>
                <div id="back-nav-button">
                   
                </div>
            </div>
            <div id="sidebuttons">
                <div class="volume-up"></div>
                <div class="power-button"></div>
            </div>
        </div>
    </div>
		<center><strong>This is not your final app. just a similar preview. </strong></center>	    
			</div>
			</div>
		</div>
		<style>
.pro_title {
    background-color: #32373c;
    padding: 10px;
    font-size: 16px;
}


.pro_banner ul {
    text-align: left;
    padding: 20px;
}



.pro_banner a {
    padding: 7px;
    background-color: #1ebea5;
    color: #fff;
    text-decoration: none;
}

.pro_banner {
    max-width: 300px;
    background-color: #23282d;
    color: #fff;
    text-align: center;
}


		    .wptonativeandroidsettings_flex {
    display: flex;
}

.wptonativeandroidsettings_flex form {
    width:50%;
}


.bottom_menu {
    background-color: #ffffff;
    width: 100%;
    height: 50px;
    position: absolute;
    bottom: -4px;
    -webkit-box-shadow: 5px -36px 32px -43px rgba(0,0,0,0.53);
    -moz-box-shadow: 5px -36px 32px -43px rgba(0,0,0,0.53);
    box-shadow: 5px 4px 19px -3px rgba(0, 0, 0, 0.5);
    display: flex;
}

#frame {
    width: 330px;
    height: 640px;
    display: block;
    margin: auto;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

#innerFrame {
    background: #000000  !important;
    width: inherit;
    height: inherit;
    border-radius: 2rem;
}

.front-camera {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: black;
    position: absolute;
    top: 2rem;
    margin-left: 2rem;
    border: 2px solid gray;
}

.front-speaker {
    width: 4rem;
    height: 8px;
    background: grey;
    border-radius: 4PX;
    position: absolute;
    top: 2.25rem;
    margin-left: 7.8rem;
}

.light-sensor {
    width: 1.5rem;
    height: 15px;
    background: black;
    border-radius: 2rem;
    position: absolute;
    margin-left: 15rem;
    top: 2rem;
}

#screen {
    width: 320px;
    height: 540px;
    background: white;
    position: absolute;
    top: 3.6rem;
    margin-left: 5px;
}

.home-menu.cat1 {
    width: 1rem;
}

.div1.home-menu.cat1 {
    transform: translate(20px, 2px) rotate(-25deg);
}

.div2.home-menu.cat1 {
    transform: translate(33px, 2px) rotate(25deg);
}

.div3.home-menu.cat1 {
    transform: translate(44px, -3.5px);
    width: 2px;
    height: 0.40rem;
}

.div4.home-menu {
    transform: translate(23px, 4px);
    width: 2px;
    height: 0.6rem;
}

.div5.home-menu {
    transform: translate(44px, 4px);
    width: 2px;
    height: 0.6rem;
}

.div6.home-menu {
    transform: translate(23px, 14px);
    width: 1.439rem;
    height: 2px;
}

.home-menu {
    position: absolute;
    top: 38.5rem;
    background: white;
    width: 2px;
    height: 1.7px;
    margin-left: 7.5rem;
}

#option-button .menu {
    width: 1.6rem;
    height: 2px;
    margin-left: 2.5rem;
    position: absolute;
    background: white;
}

.menu.stack1 {
    top: 38.5rem;
}

.menu.stack2 {
    top: 39rem;
    width: 1.2rem !important;
    margin-left: 2.87rem !important;
}

.menu.stack3 {
    top: 39.5rem;
    width: 1.2rem !important;
    margin-left: 2.87rem !important;
}

#back-nav-button>div {
    margin-left: 15.5rem;
    top: 39rem;
    position: absolute;
    width: 2rem;
    height: 2px;
    background: white;
    border-radius: 2px;
}

.arrow-head.stack1 {
    transform: translate(0px, -3px) rotate(-19deg);
    width: 0.9rem !important;
}

.arrow-head.stack2 {
    transform: translate(0px, 3px) rotate(19deg);
    width: 0.9rem !important;
}

.arrow-shaft {
    width: 1.6rem !important;
}

#back-nav-button>div.arrow.tail {
    transform: translate(23px, 2px) rotate(45deg);
    width: 0.4rem !important;
}

.volume-up {
    width: 5px;
    height: 5.5rem;
    position: absolute;
    margin-left: 20.58rem;
    /*background: slategrey;*/
    background: #9E9E9E;
    top: 5rem;
    border-top-right-radius: 3.5px;
    border-bottom-right-radius: 3.5px;
}

.power-button {
    width: 5px;
    height: 3rem;
    position: absolute;
    margin-left: 20.58rem;
    background: #9E9E9E;
    top: 12rem;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}


.wptonativeandroidsettings_preview {
    position: relative;
}

.wpna_title {
    margin-top: 10px;
    margin-left: 10px;
    font-weight: 700;
    font-size: 20px;
}

.featured_area {
    margin-top: 21px;
    display: flex;
}

.featured_text {
    width: 50%;
    font-size: 24px;
    font-weight: 700;
    margin-left: 10px;
}

.featured_btn {
    width: 50%;
    text-align: right;
    margin-right: 12px;
}

.featured_btn button {
    border: none;
    padding: 8px;
    border-radius: 8px;
}


.icon_menu {
       text-align: center;
    width: 50%;
    margin-top: 6px;
}

#featured_cat {
        width: 56%;
}
			
	img.wppt_upload_image_preview {
    width: 82px;
}		

img.f_image {
    width: 100%;
}
		</style>
		<script>
		    jQuery("#featured_text").on("keyup", function(){
		        
		         jQuery("#f_change_preview").text(jQuery(this).val());
		    });
		    
		     jQuery("#latest_text").on("keyup", function(){
		        
		         jQuery("#l_change_preview").text(jQuery(this).val());
		    });
		    
		    
		      jQuery("#app_name").on("keyup", function(){
		        
		         jQuery(".wpna_title").text(jQuery(this).val());
		    });
		    
		       jQuery("#brand_color").on("change", function(){
		        
		         jQuery("#active_color").css('color',jQuery(this).val());
		    });
		    
		    
		     jQuery("#showall_text").on("keyup", function(){
		        
		         jQuery(".featured_btn button").text(jQuery(this).val());
		    });
		   
jQuery("#tab1_text").on("keyup", function(){
		        
		         jQuery("#tab1").text(jQuery(this).val());
		    });


jQuery("#tab2_text").on("keyup", function(){
		        
		         jQuery("#tab2").text(jQuery(this).val());
		    });


jQuery("#tab3_text").on("keyup", function(){
		        
		         jQuery("#tab3").text(jQuery(this).val());
		    });
		    
		</script>
	<?php }
	
	

	


/* Other Function */



	public function wptonativeandroidsettings_page_init() {
		register_setting(
			'wptonativeandroidsettings_option_group', // option_group
			'wptonativeandroidsettings_option_name', // option_name
			array( $this, 'wptonativeandroidsettings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'wptonativeandroidsettings_setting_section', // id
			'Settings', // title
			array( $this, 'wptonativeandroidsettings_section_info' ), // callback
			'wpp-settings-admin' // page
		);

       add_settings_field(
			'wptonativeandroidsettings_app_name', // id
			'App Name', // title
			array( $this, 'wptonativeandroidsettings_app_name_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);


		add_settings_field(
			'wptonativeandroidsettings_brand_color', // id
			'Brand Color', // title
			array( $this, 'wptonativeandroidsettings_brand_color_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);
		
		
		add_settings_field(
			'wptonativeandroidsettings_featured_text', // id
			'Featured Text', // title
			array( $this, 'wptonativeandroidsettings_featured_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);
		
		
		add_settings_field(
			'wptonativeandroidsettings_featured_cat', // id
			'Featured Category', // title
			array( $this, 'wptonativeandroidsettings_featured_cat_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);

		add_settings_field(
			'wptonativeandroidsettings_latest_text', // id
			'Latest Text', // title
			array( $this, 'wptonativeandroidsettings_latest_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);
		
		
		add_settings_field(
			'wptonativeandroidsettings_showall_text', // id
			'Show All Text', // title
			array( $this, 'wptonativeandroidsettings_showall_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);


      add_settings_field(
			'wptonativeandroidsettings_tab1_text', // id
			'Home Tab Text', // title
			array( $this, 'wptonativeandroidsettings_tab1_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);


 add_settings_field(
			'wptonativeandroidsettings_tab2_text', // id
			'Category Tab Text', // title
			array( $this, 'wptonativeandroidsettings_tab2_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);


 add_settings_field(
			'wptonativeandroidsettings_tab3_text', // id
			'Search Tab Text', // title
			array( $this, 'wptonativeandroidsettings_tab3_text_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);
		
		
		add_settings_field(
			'wptonativeandroidsettings_app_icon', // id
			'App Icon', // title
			array( $this, 'wptonativeandroidsettings_app_icon_callback' ), // callback
			'wpp-settings-admin', // page
			'wptonativeandroidsettings_setting_section' // section
		);
		
		
		
		
	
		
		
	}



	public function wptonativeandroidsettings_section_info(){
		
	}
	
	public function wptonativeandroidsettings_app_name_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[app_name]" id="app_name" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['app_name'] ) ? esc_attr( $this->wptonativeandroidsettings_options['app_name']) : ''
		);
	}

	public function wptonativeandroidsettings_brand_color_callback() {
		printf(
			'<input class="regular-text" type="color" name="wptonativeandroidsettings_option_name[brand_color]" id="brand_color" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['brand_color'] ) ? esc_attr( $this->wptonativeandroidsettings_options['brand_color']) : ''
		);
	}
	
	
	
	
	public function wptonativeandroidsettings_featured_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[featured_text]" id="featured_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['featured_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['featured_text']) : ''
		);
	}
	
	
	public function wptonativeandroidsettings_latest_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[latest_text]" id="latest_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['latest_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['latest_text']) : ''
		);
	}
	
	
	public function wptonativeandroidsettings_featured_cat_callback() {
	    
		
		$featured_cat = $this->wptonativeandroidsettings_options['featured_cat'];
		$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

		?>
		<select name="wptonativeandroidsettings_option_name[featured_cat]" id="featured_cat" required>
  <option value="">Select Featured Category</option>
  <?php foreach( $categories as $category ) { ?>
  <option value="<?php echo $category->term_id; ?>" <?php if($featured_cat == $category->term_id){?> selected <?php } ?>  ><?php echo $category->name; ?></option>
  
  <?php } ?>

</select>
		
		<?php
	}
	
	
		public function wptonativeandroidsettings_showall_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[showall_text]" id="showall_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['showall_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['showall_text']) : ''
		);
	}



public function wptonativeandroidsettings_tab1_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[tab1_text]" id="tab1_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['tab1_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['tab1_text']) : ''
		);
	}



public function wptonativeandroidsettings_tab2_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[tab2_text]" id="tab2_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['tab2_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['tab2_text']) : ''
		);
	}


public function wptonativeandroidsettings_tab3_text_callback() {
	    
		printf(
			'<input class="regular-text" type="text" name="wptonativeandroidsettings_option_name[tab3_text]" id="tab3_text" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['tab3_text'] ) ? esc_attr( $this->wptonativeandroidsettings_options['tab3_text']) : ''
		);
	}
	
	
		public function wptonativeandroidsettings_app_icon_callback() {
	    
		printf(
			'<input class="regular-text" type="hidden" name="wptonativeandroidsettings_option_name[app_icon]" id="app_icon" value="%s" required>',
			isset( $this->wptonativeandroidsettings_options['app_icon'] ) ? esc_attr( $this->wptonativeandroidsettings_options['app_icon']) : ''
		);
		printf(
			'<button type="button" class="wppt_upload_image_button">Select Icon</button>'
		);
			echo '<p><img  class="wppt_upload_image_preview" src="'.$this->wptonativeandroidsettings_options['app_icon'].'"></p>';
	}
	
	

}
if ( is_admin() )
	$wptonativeandroidsettings = new WPtoAndroidSettings();



/* 
 * Retrieve this value with:
 * $wptonativeandroidsettings_options = get_option( 'wptonativeandroidsettings_option_name' ); // Array of All Options
 * $vendor_id_0 = $wptonativeandroidsettings_options['vendor_id_0']; // Vendor ID
 * $vendor_auth_code_1 = $wptonativeandroidsettings_options['vendor_auth_code_1']; // Vendor Auth Code
 */