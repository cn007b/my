Vagrant.configure(2) do |config|
  config.vm.define "ed" do |t|
  end
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "forwarded_port", guest: 22, host: 1234
  config.vm.synced_folder "ed", "/var/www/html"
  config.vm.provision :shell, path: "vagrant/provision.sh"
end
