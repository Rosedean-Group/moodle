   #!/bin/bash
   git fetch upstream
   for BRANCH in MOODLE_401_STABLE master; do
       git push origin refs/remotes/upstream/$BRANCH:refs/heads/$BRANCH
   done
