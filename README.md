# Filament Menu Top Switcher

A simple FilamentPHP plugin that allows switching between Top Navigation and Sidebar layouts dynamically — perfect for customizing the look and feel of your admin panel based on user preferences.

## Installation

To install the `filament-menu-top-switcher` plugin, follow these steps:

1. **Install the package via Composer**:

   Run the following command in your terminal to install the plugin:

   ```bash
   composer require ngankt2/filament-menu-top-switcher
   ```

2. **Register the plugin in your Filament Panel**:

   Open your Filament Panel Provider (e.g., `AdminPanelProvider.php`) and add the plugin to the panel configuration. Typically, this file is located in the `app/Providers` directory.

   ```php
   use Ngankt2\FilamentMenuTopSwitcher\FilamentMenuTopSwitcherPlugin;

   public function panel(Panel $panel): Panel
   {
       return $panel
           // ... other panel configurations
           ->plugin(FilamentMenuTopSwitcherPlugin::make());
   }
   ```

   This registers the `filament-menu-top-switcher` plugin with your Filament panel.

## Usage

Once the plugin is installed and registered, it enables users to dynamically switch between **Top Navigation** and **Sidebar** layouts in the Filament admin panel. The plugin provides a seamless way to toggle between these layouts, allowing users to customize the admin panel's look and feel based on their preferences.

### Features
- **Dynamic Switching**: Users can toggle between Top Navigation and Sidebar layouts directly within the admin panel.
- **User Preference**: The plugin respects user preferences, ensuring a personalized experience.
- **Seamless Integration**: Works out-of-the-box with FilamentPHP v3.0 and above, requiring minimal setup.

### Customizing Translations

To customize the plugin's language translations, you can publish the translation files and modify them as needed.

1. **Publish the translation files**:

   Run the following Artisan command to publish the translation files to your application's `lang` directory:

   ```bash
   php artisan vendor:publish --tag=filament-menu-top-switcher-translations
   ```

   This will copy the plugin's translation files to `lang/vendor/filament-menu-top-switcher` in your application.

2. **Edit the translations**:

   Navigate to the published translation files (e.g., `lang/vendor/filament-menu-top-switcher/en.json` for English) and modify the text to suit your needs. You can also add new language files for other locales by creating additional JSON files in the same directory.

### Configuration
No additional configuration is required after registering the plugin. The plugin automatically integrates with your Filament panel and adds the layout-switching functionality to the user interface.

### Requirements
- **PHP**: `^8.1 | ^8.2 | ^8.3`
- **FilamentPHP**: `^3.0`
- **spatie/laravel-package-tools**: `^1.15.0`

## Contributing
Contributions are welcome! If you would like to contribute to this plugin, please follow these steps:
1. Fork the repository on GitHub: [ngankt2/filament-menu-top-switcher](https://github.com/ngankt2/filament-menu-top-switcher).
2. Create a new branch for your feature or bug fix.
3. Submit a pull request with your changes.

## License
This package is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Support
For issues, questions, or feature requests, please open an issue on the [GitHub repository](https://github.com/ngankt2/filament-menu-top-switcher).