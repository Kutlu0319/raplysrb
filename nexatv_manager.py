import yaml

class NexaTVManager:
    def __init__(self, config):
        self.proxy_prefix = config['proxy_prefix']
        self.base_stream_url = config['base_stream_url']
        self.logo_url = config['logo_url']
        self.group_title = config['group_title']
        self.channels = config['channels']

    def calistir(self):
        m3u = []
        for channel in self.channels:
            real_url = f"{self.base_stream_url}{channel['path']}"
            stream_url = f"{self.proxy_prefix}{real_url}"
            m3u.append(f'#EXTINF:-1 tvg-id="sport.tr" tvg-name="{channel["name"]}" tvg-logo="{self.logo_url}" group-title="{self.group_title}",{channel["name"]}')
            m3u.append(stream_url)
        content = "\n".join(m3u)
        print(f"NexaTV içerik uzunluğu: {len(content)}")
        return content

if __name__ == "__main__":
    # YAML dosyasını okuyup config olarak yükleme
    with open("config.yaml", "r", encoding="utf-8") as file:
        config = yaml.safe_load(file)

    manager = NexaTVManager(config)
    m3u_content = manager.calistir()
    print(m3u_content)
