docker run -ti --rm -v $PWD:/gh -w /gh tensorflow/tensorflow sh -c '
  python3 ed/ai/ml/tensorflow/examples/one.py
'

# regression
cd ed/ai/ml/tensorflow/examples
virtualenv ./venv
source ./venv/bin/activate
pip3 install numpy matplotlib tensorflow tensorboard
python3 regression.py
tensorboard --logdir=/tmp/tf_logs --bind_all
open http://localhost:6006/
deactivate
# or
docker run -ti --rm --net=xnet -p 6006:6006 -v $PWD:/gh -w /gh cn007b/python /bin/bash
# ⬆