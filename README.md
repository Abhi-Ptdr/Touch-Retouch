# Touch-Retouch

## Overview
Touch Retouch is a web-based photo retouching application that allows users to upload images, apply edits, and manage their photos effectively. It combines intuitive user interfaces and backend functionality to provide an accessible platform for image enhancement and manipulation. The application also features user authentication for personalized experiences.

## Features
### User Authentication
- **Sign-Up**: New users can register by providing an email and password.
- **Login**: Existing users can log in to access their personalized dashboard.
- **Stay Logged In**: Users can choose to remain logged in using cookies.

### Image Editing
- **Original vs. Edited Previews**: Users can view original and retouched images with a flip effect.
- **Preset Filters**: Predefined settings to enhance photos with a single click.

### User Dashboard
- **Image Management**: Uploaded images are stored and organized into `ImagesOriginal/` (originals) and `ImagesEdited/` (retouched versions).
- **Secure Access**: User-specific access to uploaded and edited images.

### Additional Features
- **Responsive Design**: User interface adapts to different devices for seamless interaction.
- **Error Handling**: Provides feedback for invalid input or unsuccessful operations.

## Technology Stack
### Frontend
- **HTML/CSS**: For designing the interface and structure.
- **JavaScript**: For interactive features.
- **Bootstrap**: Used for responsive and modern design elements.

### Backend
- **PHP**: Handles server-side logic, user authentication, and image management.
- **MySQL**: Manages user data and image metadata.

### Security
- Passwords are hashed using MD5 with a salt (though migrating to bcrypt or Argon2 is recommended for better security).

## How It Works
1. **User Authentication**: Users sign up or log in to access the application.
2. **Image Upload**: Original images are stored in the `ImagesOriginal/` directory.
3. **Image Editing**: Retouched versions are saved in the `ImagesEdited/` directory.
4. **Preset Application**: Users can apply predefined presets to images for quick editing.
5. **Preview and Download**: Users can preview and download presets.

## Project Structure
```
Touch-Retouch/
├── ImagesOriginal/       # Stores original uploaded images
├── ImagesEdited/         # Stores edited/retouched images
├── Presets/              # Predefined presets for photo editing
├── index.php             # Main entry point for the application
├── loggedinpage.php      # User dashboard after login
├── connection.php        # Database connection script
├── updatedatabase.php    # Handles updates to the database
├── top.php               # Common header and reusable components
├── base.php              # Common footer and reusable components
```

## Developer's Role
As the developer of Touch Retouch, I am responsible for:
1. **Backend Development**: Implementing user authentication, session management, and database interactions.
2. **Frontend Design**: Creating an intuitive interface for seamless user interaction.
3. **Image Management**: Handling file uploads, storage, and retrieval of original and edited images.
4. **Error Handling**: Ensuring robust validation and feedback mechanisms for user input.
5. **Security**: Securing user data and authentication processes.
6. **Optimization**: Enhancing performance and ensuring a smooth user experience.

## Future Enhancements
- **Advanced Image Editing**: Adding custom editing tools (crop, resize, etc.).
- **Cloud Storage Integration**: Storing images securely in the cloud.
- **Mobile App**: Extending functionality to Android and iOS platforms.
- **Enhanced Security**: Migrating to bcrypt/Argon2 for password hashing.

## Getting Started
1. Clone the repository:
   ```bash
   git clone https://github.com/Abhi-Ptdr/Touch-Retouch.git
   ```
2. Set up a local server (e.g., XAMPP or WAMP).
3. Import the MySQL database schema from `connection.php`.
4. Start the application in your browser by accessing `index.php`.

## Contact
For any inquiries or contributions, feel free to reach out:
- **GitHub**: [Abhi-Ptdr](https://github.com/Abhi-Ptdr)
- **Email**: abhipatidar253@gmail.com
