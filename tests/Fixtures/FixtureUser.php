<?php

namespace Laradic\Tests\Support\Fixtures;

class FixtureUser
{

    public $index = 1;

    public $guid = 'fe6e123d-8cd2-4565-9f64-5785f419b9b9';

    public $isActive = false;

    public $balance = '$1,911.73';

    public $picture = 'http://placehold.it/32x32';

    public $age = 40;

    public $eyeColor = 'blue';

    public $name = 'Sheryl Burt';

    public $gender = 'female';

    public $company = 'RECRISYS';

    public $email = 'sherylburt@recrisys.com';

    public $phone = '+1 (811) 539-3752';

    public $address = '352 Winthrop Street, Johnsonburg, Maine, 4291';

    public $about = 'Nulla';

    public $registered = '2018-05-15T11:20:35 -02:00';

    public $latitude = -86.23831;

    public $longitude = 158.266993;

    public $tags = [];

    public $friends = [];

    public $greeting = 'Hello, Sheryl Burt! You have 8 unread messages.';

    public $favoriteFruit = 'strawberry';

    public static function make(array $data = [])
    {
        return new static($data);
    }

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex(int $index)
    {
        $this->index = $index;
        return $this;
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function setGuid(string $guid)
    {
        $this->guid = $guid;
        return $this;
    }

    public function isActive()
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance(string $balance)
    {
        $this->balance = $balance;
        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
        return $this;
    }

    public function getEyeColor()
    {
        return $this->eyeColor;
    }

    public function setEyeColor(string $eyeColor)
    {
        $this->eyeColor = $eyeColor;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
        return $this;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany(string $company)
    {
        $this->company = $company;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setAbout(string $about)
    {
        $this->about = $about;
        return $this;
    }

    public function getRegistered()
    {
        return $this->registered;
    }

    public function setRegistered(string $registered)
    {
        $this->registered = $registered;
        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getFriends()
    {
        return $this->friends;
    }

    public function setFriends(array $friends)
    {
        $this->friends = $friends;
        return $this;
    }

    public function getGreeting()
    {
        return $this->greeting;
    }

    public function setGreeting(string $greeting)
    {
        $this->greeting = $greeting;
        return $this;
    }

    public function getFavoriteFruit()
    {
        return $this->favoriteFruit;
    }

    public function setFavoriteFruit(string $favoriteFruit)
    {
        $this->favoriteFruit = $favoriteFruit;
        return $this;
    }


}
