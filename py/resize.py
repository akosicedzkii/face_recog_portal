from PIL import Image
from resizeimage import resizeimage

fd_img = open('test-image.jpeg', 'r')
img = Image.open(fd_img)
img = resizeimage.resize_cover(img, [200, 100])
img.save('test-image-cover.jpeg', img.format)
fd_img.close() 