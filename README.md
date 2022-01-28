## WaitLister API

Contains an API endpoint that helps people to join a waitlist. The waitlist accomodates two types of waitlisters:
-Investors
-Asset listers

## Step 1: Cloning the repository

It is either you download the repo or clone it using your terminal. To clone the repo, Navigate to the folder were you will be lunching your project, then run the command below

<copy-button> git clone git@github.com:zeefola/waitlist-api.git </copy-button>

After cloning successfully, you should see the file successfully downloaded to the directory you specified.

## Step 2: Editing your enviroment variables

Laravel comes with a .env.example file, with all typical configuration values. 

To run the project on your local machine, do the following:

1. Run cp .env.example .env to copy the example file contents into .env file.
2. Edit the new .env file, in your text editor.

## Step 3: Running composer install

Run composer install

## Step 4: Generate the application key

Run php artisan key:generate

## Step 6: Migrating DB Schema.

Run php artisan migrate

## Available API Route

-- WaitLister
Request Description: This request is used to sign up waitlisters into the waitlist

url: /waitlist/sign-up

method: signUp

action: post

## Test on Postman
url: https://watlist-api.herokuapp.com/api/waitlist/sign-up
method: POST
