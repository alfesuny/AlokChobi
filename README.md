# আলোক ছবি (Alok Chhobi) - Image Sharing Platform

Welcome to আলোক ছবি, an image sharing platform where users can upload their images, like pictures shared by others, and receive personalized image recommendations based on their preferences. This platform is built using PHP and MySQL.

## Getting Started

To run আলোক ছবি on your local machine, follow these steps:

### Prerequisites

1. Install XAMPP: You will need XAMPP, a web server solution stack, to run the platform locally. You can download XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html) and install it following their instructions.

### Installation

1. Clone the Repository: Clone this repository to your local machine or download and extract the ZIP file.

2. Database Setup:
   - Create a MySQL database named 'webprogramming'.
   - Import the provided SQL file (located in the 'sql' directory) into the 'webprogramming' database. This SQL file contains the necessary schemas and some sample data.

### Running the Platform

1. Start XAMPP: Launch the XAMPP control panel and start the Apache web server and MySQL database.

2. Access the Platform: Open a web browser and navigate to `http://localhost/your-installation-directory/` to access the আলোক ছবি platform. Replace `your-installation-directory` with the actual directory where you placed the platform files.

## Features

- **Image Upload:** Users can upload their images to share with the community.

- **Like Images:** Users can like images uploaded by others.

- **Personalized Recommendations:** The platform calculates Jaccard similarity values between users based on their liked images. It recommends images from users with the highest Jaccard similarity.

- **Top Jaccard Values:** The platform also displays the top 4 Jaccard similarity values at the top of the recommendations section.

<!-- ## Contributing

Contributions to আলোক ছবি are welcome! Please follow our [Contributing Guidelines](CONTRIBUTING.md) to get started. -->

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or feedback, feel free to contact us at [alfeysuny@gmail.com](mailto:alfeysuny@gmail.com).

Happy sharing images on আলোক ছবি!
