# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

boxPath = '/Users/foued/Development/'
box = 'myCentos65'

hostname = 'recaptcha'
domain   = 'local.net'
ip       = '192.168.0.66'
ram      = '2048'


Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  if defined? VagrantPlugins::ProxyConf
    config.proxy.http     = ""
    config.proxy.https    = "$http_proxy"
    config.proxy.no_proxy = "localhost,127.0.0.1"
  end

  config.vm.box = box
  config.vm.box_url = boxPath+ box + '.box'
  config.vm.box_download_insecure = true

  config.vm.host_name = hostname +'.'+domain
  config.vm.network "private_network", ip: ip

  config.vm.synced_folder ".", "/vagrant"
  if defined? VagrantPlugins::Bindfs
    config.vm.synced_folder ".", "/vagrant", disabled: true
    config.vm.synced_folder ".", "/vagrant-nfs", type: "nfs", nfs_udp: false
    config.bindfs.bind_folder "/vagrant-nfs", "/vagrant"
  end

  config.vm.provider :virtualbox do |vb|
    vb.customize [
      'modifyvm', :id,
      '--name', hostname,
      '--memory', ram
    ]
  end
end
