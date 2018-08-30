Vagrant.configure("2") do |config|
  config.vbguest.auto_update = false
  config.vbguest.no_remote = true
  config.vm.box = "front_app"
  config.vm.box_url = "https://github.com/tommy-muehle/puppet-vagrant-boxes/releases/download/1.1.0/centos-7.0-x86_64.box"
  config.vm.network "private_network", ip: "192.168.33.100"

  config.vm.provider "virtualbox" do |vb|
     vb.memory = "1024"
  end

  config.vm.provision "shell", inline: <<-SHELL
    LANG=en_US.UTF-8
    sudo localectl set-locale LANG=en_US.UTF-8
    sudo timedatectl set-timezone Asia/Tokyo
    sudo yum update -y
    sudo yum install -y net-tools wget git yum-utils zip unzip
    sudo yum -y groupinstall "Development tools"
    sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
    sudo rpm -Uvh http://rpms.remirepo.net/enterprise/remi-release-7.rpm
    sudo yum remove -y httpd
    sudo yum install -y httpd
    sudo yum-config-manager --enable remi-php72
    sudo yum -y install php php-common php-pdo php-mysql php-mbstring php-xml php-xdebug php-zip php72-php
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    sudo yum install -y nodejs
    sudo systemctl stop firewalld
    sudo systemctl is-enabled firewalld
  SHELL
end